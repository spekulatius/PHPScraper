<?php

namespace Spekulatius\PHPScraper;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait UsesGoutte
{
    /**
     * Holds the client
     *
     * @var Goutte\Client
     */
    protected $client = null;

    /**
     * Holds the HttpClient
     *
     * @var Symfony\Contracts\HttpClient\HttpClientInterface;
     */
    protected $httpClient = null;

    /**
     * Holds the current page (a Crawler object)
     *
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $currentPage = null;

    /**
     * Overwrites the client
     *
     * @param \Goutte\Client $client
     */
    public function setClient(GoutteClient $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Overwrites the httpClient
     *
     * @param Symfony\Contracts\HttpClient\HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Retrieve the client
     *
     * @param \Goutte\Client $client
     */
    public function client(): GoutteClient
    {
        return $this->client;
    }

    /**
     * Any URL-related methods are in `UsesUrls.php`.
     **/

    /**
     * Navigates to a new page using an URL.
     *
     * @param string $url
     */
    public function go(string $url): self
    {
        // Keep it around for internal processing.
        $this->currentPage = $this->client->request('GET', $url);

        return $this;
    }

    /**
     * Allows to set HTML content to process.
     *
     * This is intended to be used as a work-around, if you already have the DOM.
     *
     * @param string $url
     * @param string $content
     */
    public function setContent(string $url, string $content): self
    {
        // Overwrite the current page with a fresh Crawler instance of the content.
        $this->currentPage = new Crawler($content, $url);

        return $this;
    }

    /**
     * Fetch an asset from a given absolute or relative URL
     *
     * @param string $url
     */
    public function fetchAsset(string $url)
    {
        return $this
            ->httpClient
            ->request(
                'GET',
                ($this->currentPage === null) ? $url : $this->makeUrlAbsolute($url),
            )
            ->getContent();
    }

    /**
     * Click a link (either with title or url)
     *
     * @param string $titleOrUrl
     */
    public function clickLink($titleOrUrl): self
    {
        // If the string starts with http just go to it - we assume it's an URL
        if (\stripos($titleOrUrl, 'http') === 0) {
            // Go to a URL
            $this->go($titleOrUrl);
        } else {
            // Find link based on the title
            $link = $this->currentPage->selectLink($titleOrUrl)->link();

            // Click the link and store the DOMCrawler object
            $this->currentPage = $this->client->click($link);
        }

        return $this;
    }

    public function isTemporaryResult(): bool
    {
        return $this->usesTemporaryRedirect() || \in_array($this->statusCode(), [
            408, // Request Timeout
            409, // Conflict
            419, // Page Expired
            420, // Enhance Your Calm
            421, // Misdirected Request
            423, // Locked
            425, // Too Early
            429, // Too Many Requests
            499, // Client Closed Request (Timeout)
            500, // Internal Server Error
            502, // Bad Gateway
            503, // Service Unavailable
            504, // Gateway Timeout
            507, // Insufficient Storage
            520, // Web Server returned an unknown error
            521, // Web Server is down
            522, // Connection Timed Out
            523, // Origin is unreachable
            524, // A timeout occurred
            525, // SSL Handshake Failed
            527, // Railgun Error
            529, // Site is overloaded
            598, // Network read timeout error
            599, // Network Connect Timeout Error
        ]);
    }

    public function isGone(): bool
    {
        return !$this->isTemporaryResult() && $this->statusCode() === 410 /* Gone */;
    }

    public function isPermanentError(): bool
    {
        return (!$this->statusCode() || $this->statusCode() >= 400) && !$this->isTemporaryResult();
    }

    public function usesTemporaryRedirect(): bool
    {
        return $this->client ? $this->client->usesTemporaryRedirect : false;
    }

    public function permanentRedirectUrl(): string
    {
        return $this->client ? ($this->client->permanentRedirectUrl ?? '') : '';
    }

    public function retryAt(): int
    {
        $retryAt = $this->client ? ($this->client->retryAt()) : 0;
        if ($retryAt) {
            return $retryAt;
        }
        if ($this->statusCode() === 509 /* Bandwidth Limit Exceeded */) {
            return strtotime('next month 12:00 UTC');
        }    // give providers in each timezone the chance to reset the traffic quota for month
        return 0;
    }

    public function statusCode(): int
    {
        if ($this->currentPage === null) {
            throw new \Exception('You can not access the status code before your first navigation using `go`.');
        }

        return $this->client->getResponse()->getStatusCode();
    }

    public function isSuccess(): bool
    {
        return $this->statusCode() >= 200 && $this->statusCode() <= 299;
    }

}
