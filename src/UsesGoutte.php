<?php

namespace spekulatius;

use League\Uri\Uri;
use Goutte\Client as GoutteClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\CurlHttpClient;

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
     * @var Symfony\Component\HttpClient\CurlHttpClient
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
     * @param Symfony\Component\HttpClient\CurlHttpClient $httpClient
     */
    public function setHttpClient(CurlHttpClient $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Returns the current url
     *
     * @return string $url
     */
    public function currentUrl(): string
    {
        // Ensure we aren't having a "call on null" without context.
        if ($this->currentPage === null) {
            throw new \Exception('You can not access the URL before your first navigation using `go`.');
        }

        return $this->currentPage->getUri();
    }

    /**
     * Returns the current host
     *
     * @return string $host
     */
    public function currentHost(): string
    {
        return Uri::createFromString($this->currentUrl())->getHost();
    }

    /**
     * Returns the current base URL.
     *
     * @return string $baseUrl
     */
    public function currentBaseUrl(): string
    {
        $uri = Uri::createFromString($this->currentUrl());

        return $uri->getScheme() . '://' . $uri->getHost();
    }

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
     * Fetch an asset from a given URL (for example an image)
     *
     * @param string $url
     */
    public function fetchAsset(string $url)
    {
        return $this->httpClient->request('GET', $url)?->getContent();
    }

    /**
     * Click a link (either with title or url)
     *
     * @param string $titleOrUrl
     * @return boolean
     */
    public function clickLink($titleOrUrl)
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

        return true;
    }
}