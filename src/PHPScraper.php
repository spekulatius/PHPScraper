<?php

namespace Spekulatius\PHPScraper;

/**
 * This class manages the Clients and connections.
 *
 * Most calls are passed through to the Core class.
 */

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient as SymfonyHttpClient;

/**
 * @phpstan-type PHPScraperConfig array{'follow_redirects'?: bool, 'follow_meta_refresh'?: bool, 'max_redirects'?: int, 'agent'?: string, 'proxy'?: string|null, 'timeout'?: int, 'disable_ssl'?: bool}
 *
 * All methods and properties below are proxied through `__call()`/`__get()` to the Core class
 * (and the traits it uses). They are documented here purely for IDE/static-analysis support.
 *
 * Url related helpers (see UsesUrls):
 * @property-read string $currentUrl
 * @property-read string|null $currentHost
 * @property-read string $currentBaseHost
 * @property-read string|null $makeUrlAbsolute
 * @method string currentUrl()
 * @method string|null currentHost()
 * @method string currentBaseHost()
 * @method string|null makeUrlAbsolute(string|null $url = null, string|null $baseUrl = null)
 *
 * BrowserKit interaction (see UsesBrowserKit):
 * @property-read \Symfony\Component\BrowserKit\HttpBrowser $client
 * @method self setClient(\Symfony\Component\BrowserKit\HttpBrowser $client)
 * @method self setHttpClient(\Symfony\Contracts\HttpClient\HttpClientInterface $httpClient)
 * @method \Symfony\Component\BrowserKit\HttpBrowser client()
 * @method self go(string $url)
 * @method self setContent(string $url, string $content)
 * @method string fetchAsset(string $url)
 * @method self clickLink(string $titleOrUrl)
 *
 * XPath based filters (see UsesXPathFilters):
 * @method \Symfony\Component\DomCrawler\Crawler filter(string $query)
 * @method \Symfony\Component\DomCrawler\Crawler|null filterFirst(string $query)
 * @method string|null filterFirstText(string $query)
 * @method array<string> filterTexts(string $query)
 * @method array<string> filterExtractAttributes(string $query, array<string> $attributes)
 * @method string|null filterFirstExtractAttribute(string $query, array<string> $attributes)
 * @method string|null filterFirstContent(string $query)
 *
 * Content related selectors (see UsesContent):
 * @property-read string|null $title
 * @property-read string|null $charset
 * @property-read string|null $contentType
 * @property-read string|null $canonical
 * @property-read string|null $viewportString
 * @property-read array<mixed> $viewport
 * @property-read string|null $csrfToken
 * @property-read string|null $baseHref
 * @property-read array<mixed> $headers
 * @property-read string|null $author
 * @property-read string|null $image
 * @property-read string|null $keywordString
 * @property-read array<mixed> $keywords
 * @property-read string|null $description
 * @property-read array<mixed> $metaTags
 * @property-read array<mixed> $twitterCard
 * @property-read array<mixed> $openGraph
 * @property-read array<mixed> $h1
 * @property-read array<mixed> $h2
 * @property-read array<mixed> $h3
 * @property-read array<mixed> $h4
 * @property-read array<mixed> $h5
 * @property-read array<mixed> $h6
 * @property-read array<mixed> $headings
 * @property-read array<mixed> $lists
 * @property-read array<array{type: string, children: \DOMNodeList<\DOMNode>, children_plain: array<string>}> $orderedLists
 * @property-read array<array{type: string, children: \DOMNodeList<\DOMNode>, children_plain: array<string>}> $unorderedLists
 * @property-read array<mixed> $paragraphs
 * @property-read array<mixed> $cleanParagraphs
 * @property-read array<mixed> $outline
 * @property-read array<mixed> $outlineWithParagraphs
 * @property-read array<mixed> $cleanOutlineWithParagraphs
 * @property-read array<mixed> $contentKeywords
 * @property-read array<mixed> $contentKeywordsWithScores
 * @property-read array<mixed> $links
 * @property-read array<mixed> $internalLinks
 * @property-read array<mixed> $externalLinks
 * @property-read array<mixed> $linksWithDetails
 * @property-read array<mixed> $images
 * @property-read array<mixed> $imagesWithDetails
 * @method string|null title()
 * @method string|null charset()
 * @method string|null contentType()
 * @method string|null canonical()
 * @method string|null viewportString()
 * @method array<mixed> viewport()
 * @method string|null csrfToken()
 * @method string|null baseHref()
 * @method array<mixed> headers()
 * @method string|null author()
 * @method string|null image()
 * @method string|null keywordString()
 * @method array<mixed> keywords()
 * @method string|null description()
 * @method array<mixed> metaTags()
 * @method array<mixed> twitterCard()
 * @method array<mixed> openGraph()
 * @method array<mixed> h1()
 * @method array<mixed> h2()
 * @method array<mixed> h3()
 * @method array<mixed> h4()
 * @method array<mixed> h5()
 * @method array<mixed> h6()
 * @method array<mixed> headings()
 * @method array<mixed> lists()
 * @method array<array{type: string, children: \DOMNodeList<\DOMNode>, children_plain: array<string>}> orderedLists()
 * @method array<array{type: string, children: \DOMNodeList<\DOMNode>, children_plain: array<string>}> unorderedLists()
 * @method array<mixed> paragraphs()
 * @method array<mixed> cleanParagraphs()
 * @method array<mixed> outline()
 * @method array<mixed> outlineWithParagraphs()
 * @method array<mixed> cleanOutlineWithParagraphs()
 * @method array<mixed> contentKeywords(string $locale = 'en_US')
 * @method array<mixed> contentKeywordsWithScores(string $locale = 'en_US')
 * @method array<mixed> links()
 * @method array<mixed> internalLinks()
 * @method array<mixed> externalLinks()
 * @method array<mixed> linksWithDetails()
 * @method array<mixed> images()
 * @method array<mixed> imagesWithDetails()
 *
 * Shared simple parsers for XML, JSON and CSV (see UsesFileParsers):
 * @property-read array<mixed> $parseCsv
 * @property-read array<mixed> $parseCsvWithHeader
 * @property-read array<mixed> $parseJson
 * @property-read array<mixed> $parseXml
 * @method array<mixed> csvDecodeRaw(string $csvString, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method array<mixed> csvDecode(string $csvString, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method array<mixed> csvDecodeWithHeaderRaw(string $csvString, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method array<mixed> csvDecodeWithHeader(string $csvString, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method int|float|string castType(string $entry)
 * @method array<mixed> parseCsv(string|null $csvStringOrUrl = null, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method array<mixed> parseCsvWithHeader(string|null $csvStringOrUrl = null, string|null $separator = null, string|null $enclosure = null, string|null $escape = null)
 * @method array<mixed> parseJson(string|null $jsonStringOrUrl = null)
 * @method array<mixed> parseXml(string|null $xmlStringOrUrl = null)
 *
 * Feeds related selectors and parsers: RSS, sitemap, search index, etc. (see UsesFeeds):
 * @property-read string $sitemapUrl
 * @property-read array<mixed> $sitemapRaw
 * @property-read array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> $sitemap
 * @property-read string $searchIndexUrl
 * @property-read array<mixed> $searchIndexRaw
 * @property-read array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> $searchIndex
 * @property-read array<string> $rssUrls
 * @property-read array<mixed> $rssRaw
 * @property-read array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> $rss
 * @method string sitemapUrl()
 * @method array<mixed> sitemapRaw(string|null $url = null)
 * @method array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> sitemap(string|null $url = null)
 * @method string searchIndexUrl()
 * @method array<mixed> searchIndexRaw(string|null $url = null)
 * @method array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> searchIndex(string|null $url = null)
 * @method array<string> rssUrls()
 * @method array<mixed> rssRaw(string|null ...$urls)
 * @method array<\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry> rss(string|null ...$urls)
 */
class PHPScraper
{
    /**
     * Holds the config for the clients.
     *
     * @var PHPScraperConfig
     */
    protected $config = [];

    /**
     * Holds the Core class. It handles the actual scraping.
     */
    protected Core $core;

    /**
     * @param  PHPScraperConfig  $config
     */
    public function __construct(array $config = [])
    {
        // Prepare the core. It delegates all further processing.
        $this->core = new Core;

        // And set the config.
        $this->setConfig($config);
    }

    /**
     * Sets the config, generates the required Clients and updates the core with the new clients.
     *
     * @param  PHPScraperConfig  $config
     */
    public function setConfig(array $config = []): self
    {
        // Define the default values
        $defaults = [
            // We assume that we want to follow any redirects, in reason.
            'follow_redirects' => true,
            'follow_meta_refresh' => true,
            'max_redirects' => 5,

            /**
             * Agent can be overwritten using:
             *
             * ```php
             * $web->setConfig(['agent' => 'My Agent']);
             * ```
             */
            'agent' => 'Mozilla/5.0 (compatible; PHP Scraper/1.x; +https://phpscraper.de)',

            /**
             * Setting the Proxy
             *
             * ```php
             * $web->setConfig(['proxy' => 'http://user:password@127.0.0.1:3128']);
             * ```
             */
            'proxy' => null,

            /**
             * Timeout in seconds.
             *
             * ```php
             * $web->setConfig(['timeout' => 15]);
             * ```
             */
            'timeout' => 10,

            /**
             * Disable SSL (not recommended unless really needed).
             *
             * @var bool
             */
            'disable_ssl' => false,
        ];

        // Add the defaults in
        $this->config = array_merge($defaults, $config);

        // Symfony HttpClient
        $httpClient = SymfonyHttpClient::create([
            'proxy' => $this->config['proxy'],
            'timeout' => $this->config['timeout'],
            'verify_host' => ! $this->config['disable_ssl'],
            'verify_peer' => ! $this->config['disable_ssl'],
        ]);

        // BrowserKit Client and set some config needed for it.
        $client = new HttpBrowser($httpClient);
        $client->followRedirects($this->config['follow_redirects']);
        $client->followMetaRefresh($this->config['follow_meta_refresh']);
        $client->setMaxRedirects($this->config['max_redirects']);
        $client->setServerParameter('HTTP_USER_AGENT', $this->config['agent']);

        // Set the client on the core.
        $this->core->setClient($client);
        $this->core->setHttpClient($httpClient);

        return $this;
    }

    /**
     * Catch calls to properties and process them accordingly.
     */
    public function __get(string $name): mixed
    {
        // We are assuming that all calls for properties actually method calls...
        return $this->__call($name);
    }

    /**
     * Catches the method calls and tries to satisfy them.
     *
     * @param  array<mixed>  $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments = [])
    {
        $result = $this->core->$name(...$arguments);

        // Did we get a Core class element? Keep this.
        if ($result instanceof Core) {
            $this->core = $result;

            return $this;
        }

        // Otherwise: just return whatever the core returned.
        return $result;
    }
}
