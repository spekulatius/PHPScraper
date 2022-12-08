<?php

namespace Spekulatius\PHPScraper;

use Goutte\Client as GoutteClient;
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

    public function statusCode(): int
    {
        if ($this->currentPage === null) {
            throw new \Exception('You can not access the status code before your first navigation using `go`.');
        }

        return $this->client->getResponse()->getStatusCode();
    }

    public function is2xx(): bool
    {
        return $this->statusCode() >= 200 && $this->statusCode() <= 299;
    }

    public function is3xx(): bool
    {
        return $this->statusCode() >= 300 && $this->statusCode() <= 399;
    }

    public function is4xx(): bool
    {
        return $this->statusCode() >= 400 && $this->statusCode() <= 499;
    }

    public function is5xx(): bool
    {
        return $this->statusCode() >= 500 && $this->statusCode() <= 599;
    }

    public function is200(): bool
    {
        return $this->statusCode() === 200;
    }

    public function is301(): bool
    {
        return $this->statusCode() === 301;
    }

    public function is302(): bool
    {
        return $this->statusCode() === 302;
    }

    public function is400(): bool
    {
        return $this->statusCode() === 400;
    }

    public function is401(): bool
    {
        return $this->statusCode() === 401;
    }

    public function is402(): bool
    {
        return $this->statusCode() === 402;
    }

    public function is403(): bool
    {
        return $this->statusCode() === 403;
    }

    public function is404(): bool
    {
        return $this->statusCode() === 404;
    }

    public function is500(): bool
    {
        return $this->statusCode() === 500;
    }

    public function isOk(): bool
    {
        return $this->is200();
    }

    public function isUnauthorized(): bool
    {
        return $this->is401();
    }

    public function isForbidden(): bool
    {
        return $this->is403();
    }

    public function isNotFound(): bool
    {
        return $this->is404();
    }

    public function isServerError(): bool
    {
        return $this->is500();
    }

    public function isInternalServerError(): bool
    {
        return $this->is500();
    }
}