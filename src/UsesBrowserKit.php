<?php

namespace Spekulatius\PHPScraper;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait UsesBrowserKit
{
    /**
     * Holds the client
     *
     * @var \Symfony\Component\BrowserKit\HttpBrowser
     */
    protected $client;

    /**
     * Holds the HttpClient
     *
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface;
     */
    protected $httpClient;

    /**
     * Holds the current page (a Crawler object)
     *
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $currentPage;

    /**
     * Overwrites the client
     */
    public function setClient(HttpBrowser $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Overwrites the httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * Retrieve the client
     *
     * @return \Symfony\Component\BrowserKit\HttpBrowser $client
     */
    public function client(): HttpBrowser
    {
        return $this->client;
    }

    /**
     * Any URL-related methods are in `UsesUrls.php`.
     **/

    /**
     * Navigates to a new page using an URL.
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
     */
    public function setContent(string $url, string $content): self
    {
        // Overwrite the current page with a fresh Crawler instance of the content.
        $this->currentPage = new Crawler($content, $url);

        return $this;
    }

    /**
     * Fetch an asset from a given absolute or relative URL
     */
    public function fetchAsset(string $url): string
    {
        return $this
            ->httpClient
            ->request(
                'GET',
                ($this->currentPage === null) ? $url : (string) $this->makeUrlAbsolute($url),
            )
            ->getContent();
    }

    /**
     * Click a link (either with title or url)
     *
     * @param  string  $titleOrUrl
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
}
