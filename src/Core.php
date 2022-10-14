<?php

namespace spekulatius;

/**
 * This call organizes the actual scraping calls.
 *
 * It doesn't handle any client management. That's with phpscraper.php
 */

use Pdp\Cache;
use Pdp\CurlHttpClient;
use Pdp\Manager;
use DonatelloZa\RakePlus\RakePlus;
use Goutte\Client as GoutteClient;

class Core
{
    /**
     * Holds the client
     *
     * @var Goutte\Client
     */
    protected $client = null;

    /**
     * Holds the current page (a Crawler object)
     *
     * @var Symfony\Component\DomCrawler\Crawler
     */
    protected $currentPage = null;

    /**
     * Overwrites the client
     *
     * @param GoutteClient $client
     */
    public function setClient(GoutteClient $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Returns the current url
     *
     * @return string $url
     */
    public function currentURL()
    {
        return $this->currentPage->getUri();
    }

    /**
     * Navigates to an url
     *
     * @param string $url
     */
    public function go(string $url)
    {
        $this->currentPage = $this->client->request('GET', $url);

        return $this;
    }

    /**
     * Allows to set HTML content to process.
     *
     * @param string $url
     * @param string $content
     */
    public function setContent(string $url, string $content)
    {
        $this->currentPage = new \Symfony\Component\DomCrawler\Crawler(
            $content,
            $url
        );

        return $this;
    }

    /**
     * Fetch an asset from a given URL (for example an image)
     *
     * @param string $url
     */
    public function fetchAsset(string $url)
    {
        return $this->client->request('GET', $url)->getResponse();
    }

    /**
     * Filters the current page by a xPath-query
     *
     * @param string $filter
     * @return Crawler
     */
    public function filter(string $query)
    {
        return $this->currentPage->filterXPath($query);
    }

    /**
     * Filters the current page by a xPath-query and returns the first one, or null.
     *
     * @param string $filter
     * @return Crawler|null
     */
    public function filterFirst(string $query)
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() == 0) ? null : $filteredNodes->first();
    }

    /**
     * Filters the current page by a xPath-query and returns the first ones content, or null.
     *
     * @param string $filter
     * @return ?string
     */
    public function filterFirstText(string $query): ?string
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() == 0) ? null : $filteredNodes->first()->text();
    }

    /**
     * Filters the current page by a xPath-query and returns the textual content as array.
     *
     * @param string $filter
     * @return array
     */
    public function filterTexts(string $query): array
    {
        return $this->filterExtractAttributes($query, ['_text']);
    }

    /**
     * Filters the current page by a xPath-query and returns the first ones content, or null.
     *
     * @param string $filter
     * @param array $attributes
     * @return ?array
     */
    public function filterExtractAttributes(string $query, array $attributes): ?array
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() == 0) ? [] : $filteredNodes->extract($attributes);
    }

    /**
     * Filters the current page by a xPath-query and returns the first ones content, or null.
     *
     * @param string $filter
     * @param array $attributes
     * @return ?string
     */
    public function filterFirstExtractAttribute(string $query, array $attributes): ?string
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() == 0) ? null : $filteredNodes->first()->extract($attributes)[0];
    }

    /**
     * Returns the content attribute for the first result of the query, or null.
     *
     * @param string $filter
     * @return ?string
     */
    public function filterFirstContent(string $query): ?string
    {
        return $this->filterFirstExtractAttribute($query, ['content']);
    }

    /**
     * Access conveniences: Methods, to access data easier.
     *
     * I like to have direct access to stuff without many chained calls.
     * So I've added a number of things which might be of interest.
     *
     * Any suggestions what is missing? Send a PR :)
     *
     * @see https://phpscraper.de/contributing
     */

    /**
     * Get the title
     *
     * @return ?string
     */
    public function title(): ?string
    {
        return $this->filterFirstText('//title');
    }

    /**
     * Get the content-type
     *
     * @return ?string
     */
    public function contentType(): ?string
    {
        return $this->filterFirstExtractAttribute('//meta[@http-equiv="Content-type"]', ['content']);
    }

    /**
     * Get the canonical
     *
     * @return ?string
     */
    public function canonical(): ?string
    {
        return $this->filterFirstExtractAttribute('//link[@rel="canonical"]', ['href']);
    }

    /**
     * Get the viewport as a string
     *
     * @return ?string
     */
    public function viewportString(): ?string
    {
        return $this->filterFirstContent('//meta[@name="viewport"]');
    }

    /**
     * Get the viewport as an array
     *
     * @return array
     */
    public function viewport(): array
    {
        return is_null($this->viewportString()) ?
            [] : \preg_split('/,\s*/', $this->viewportString());
    }

    /**
     * Get the csrfToken
     *
     * @return string
     */
    public function csrfToken(): ?string
    {
        return $this->filterFirstExtractAttribute('//meta[@name="csrf-token"]', ['content']);
    }

    /**
     * Get the header collected as an array
     *
     * @return array
     */
    public function headers(): array
    {
        return [
            'charset' => $this->charset(),
            'contentType' => $this->contentType(),
            'viewport' => $this->viewport(),
            'canonical' => $this->canonical(),
            'csrfToken' => $this->csrfToken(),
        ];
    }

    /**
     * Get the author
     *
     * @return string
     */
    public function author(): ?string
    {
        return $this->filterFirstContent('//meta[@name="author"]');
    }

    /**
     * Get the image
     *
     * @return string
     */
    public function image(): ?string
    {
        return $this->filterFirstContent('//meta[@name="image"]');
    }

    /**
     * Get the keyword as a string
     *
     * @return string
     */
    public function keywordString(): ?string
    {
        return $this->filterFirstContent('//meta[@name="keywords"]');
    }

    /**
     * Get the keyword as an array
     *
     * @return array
     */
    public function keywords()
    {
        return is_null($this->keywordString()) ?
            [] : \preg_split('/,\s*/', $this->keywordString());
    }

    /**
     * Get the description
     *
     * @return string
     */
    public function description()
    {
        return $this->filterFirstContent('//meta[@name="description"]');
    }

    /**
     * Get the meta collected as an array
     *
     * @return array
     */
    public function metaTags()
    {
        return [
            'author' => $this->author(),
            'image' => $this->image(),
            'keywords' => $this->keywords(),
            'description' => $this->description(),
        ];
    }

    /**
     * Gets the open graph attributes as an array
     *
     * @return array
     */
    public function twitterCard()
    {
        $data = $this
            ->filter('//meta[contains(@name, "twitter:")]')
            ->extract(['name', 'content']);

        // Prepare the data
        $result = [];
        foreach ($data as $set) {
            $result[$set[0]] = $set[1];
        }

        return $result;
    }

    /**
     * Gets the open graph attributes as an array
     *
     * @return array
     */
    public function openGraph()
    {
        $data = $this
            ->filter('//meta[contains(@property, "og:")]')
            ->extract(['property', 'content']);

        // Prepare the data
        $result = [];
        foreach ($data as $set) {
            $result[$set[0]] = $set[1];
        }

        return $result;
    }

    /**
     * Get all <h1> tags (should be usually only one)
     *
     * @return array
     */
    public function h1()
    {
        return $this->filterExtractAttributes('//h1', ['_text']);
    }

    /**
     * Get all <h2> tags
     *
     * @return array
     */
    public function h2()
    {
        return $this->filterExtractAttributes('//h2', ['_text']);
    }

    /**
     * Get all <h3> tags
     *
     * @return array
     */
    public function h3()
    {
        return $this->filterExtractAttributes('//h3', ['_text']);
    }

    /**
     * Get all <h4> tags
     *
     * @return array
     */
    public function h4()
    {
        return $this->filterExtractAttributes('//h4', ['_text']);
    }

    /**
     * Get all <h5> tags
     *
     * @return array
     */
    public function h5()
    {
        return $this->filterExtractAttributes('//h5', ['_text']);
    }

    /**
     * Get all <h6> tags
     *
     * @return array
     */
    public function h6()
    {
        return $this->filterExtractAttributes('//h6', ['_text']);
    }

    /**
     * Get all heading tags
     *
     * @return array
     */
    public function headings()
    {
        return [
            $this->h1(),
            $this->h2(),
            $this->h3(),
            $this->h4(),
            $this->h5(),
            $this->h6(),
        ];
    }

    /**
     * Get all lists on the page
     *
     * @return array
     */
    public function lists()
    {
        $lists = [];

        foreach ($this->currentPage->filter('ol, ul') as $list) {
            $lists[] = [
                'type' => $list->tagName,
                'children' => $list->childNodes,
                'children_plain' => array_values(array_filter(array_map('trim', explode("\n", $list->textContent)))),
            ];
        }

        return $lists;
    }

    /**
     * Get all ordered lists on the page
     *
     * @return array
     */
    public function orderedLists()
    {
        return array_values(array_filter($this->lists(), function ($list) {
            return $list['type'] === 'ol';
        }));
    }

    /**
     * Get all unordered lists on the page
     *
     * @return array
     */
    public function unorderedLists()
    {
        return array_values(array_filter($this->lists(), function ($list) {
            return $list['type'] === 'ul';
        }));
    }

    /**
     * Get all paragraphs of the page
     *
     * @return array
     */
    public function paragraphs()
    {
        return array_map(
            'trim',
            $this->filterExtractAttributes('//p', ['_text'])
        );
    }

    /**
     * Get the paragraphs of the page excluding empty paragraphs.
     *
     * @return array
     */
    public function cleanParagraphs()
    {
        return array_values(array_filter(
            $this->paragraphs(),
            function ($paragraph) { return $paragraph !== ''; }
        ));
    }

    /**
     * Parses the content outline of the web-page
     *
     * @return array
     */
    public function outline()
    {
        $result = $this->filterExtractAttributes('//h1|//h2|//h3|//h4|//h5|//h6', ['_name', '_text']);

        foreach ($result as $index => $array) {
            $result[$index] = array_combine(['tag', 'content'], $array);
        }

        return $result;
    }

    /**
     * Parses the content outline of the web-page
     *
     * @return array
     */
    public function outlineWithParagraphs()
    {
        $result = $this->filterExtractAttributes('//h1|//h2|//h3|//h4|//h5|//h6|//p', ['_name', '_text']);

        foreach ($result as $index => $array) {
            $result[$index] = array_combine(['tag', 'content'], $array);
            $result[$index]['content'] = trim($result[$index]['content']);
        }

        return $result;
    }

    /**
     * Parses the content outline of the web-page
     *
     * @return array
     */
    public function cleanOutlineWithParagraphs()
    {
        $result = $this->filterExtractAttributes('//h1|//h2|//h3|//h4|//h5|//h6|//p', ['_name', '_text']);

        foreach ($result as $index => $array) {
            if ($array[1] !== '') {
                $result[$index] = array_combine(['tag', 'content'], $array);
                $result[$index]['content'] = trim($result[$index]['content']);
            }
        }

        return $result;
    }

    /**
     * Internal method to prepare the content for keyword analysis
     *  done in the called methods for the rake analysis
     *
     * Uses:
     *  - Title
     *  - Headings
     *  - Paragraphs/Content
     *  - Link anchors and Titles
     *  - Alt Texts of Images
     *  - Meta Title, Description and Keywords
     *
     * @see https://github.com/Donatello-za/rake-php-plus
     * @see https://phpscraper.de/examples/extract-keywords.html
     * @see https://github.com/spekulatius/phpscraper-keyword-scraping-example
     *
     * @return array
     */
    protected function prepContent()
    {
        // Collect content strings
        $content = array_merge(
            // Website title
            [$this->title()],

            // Paragraphs
            $this->paragraphs(),

            // Various meta tags
            [
                $this->author(),
                $this->description(),
                join(' ', $this->keywords()),
            ]
        );

        // Add headings
        foreach ($this->headings() as $headings) {
            $content += array_values($headings);
        }

        // Add image alt texts in
        foreach ($this->linksWithDetails() as $link) {
            $content[] = $link['text'];
            $content[] = $link['title'];
        }
        foreach ($this->imagesWithDetails() as $image) {
            $content[] = $image['alt'];
        }

        return $content;
    }

    /**
     * Gets a set of keywords based on the rake approach.
     *
     * Uses:
     *  - Title
     *  - Headings
     *  - Paragraphs/Content
     *  - Link anchors and Titles
     *  - Alt Texts of Images
     *  - Meta Title, Description and Keywords
     *
     * @see https://github.com/Donatello-za/rake-php-plus
     * @see https://phpscraper.de/examples/extract-keywords.html
     * @see https://github.com/spekulatius/phpscraper-keyword-scraping-example
     *
     * @param string $locale (default: 'en_US')
     * @return array
     */
    public function contentKeywords($locale = 'en_US'): array
    {
        // Extract the keyword phrases and return a sorted array
        return RakePlus::create(join(' ', $this->prepContent()), $locale)
            ->sort('asc')
            ->get();
    }

    /**
     * Gets a set of keywords with scores based on the rake approach
     *
     * Uses:
     *  - Title
     *  - Headings
     *  - Paragraphs/Content
     *  - Link anchors and Titles
     *  - Alt Texts of Images
     *  - Meta Title, Description and Keywords
     *
     * @see https://github.com/Donatello-za/rake-php-plus
     * @see https://phpscraper.de/examples/extract-keywords.html
     * @see https://github.com/spekulatius/phpscraper-keyword-scraping-example
     *
     * @param string $locale (default: 'en_US')
     * @return array
     */
    public function contentKeywordsWithScores($locale = 'en_US'): array
    {
        // Extract the keyword phrases and return a sorted array
        return RakePlus::create(join(' ', $this->prepContent()), $locale)
            ->sortByScore('desc')
            ->scores();
    }

    /**
     * Get all links on the page as absolute URLs
     *
     * @see https://github.com/spekulatius/link-scraping-test-beautifulsoup-vs-phpscraper
     *
     * @return array
     */
    public function links(): array
    {
        $links = $this->filter('//a')->links();

        // Generate a list of all image entries
        $result = [];
        foreach ($links as $link) {
            $result[] = $link->getUri();
        }

        return $result;
    }

    /**
     * Get all internal links (same root or sub-domain) on the page as absolute URLs
     *
     * @return array
     */
    public function internalLinks(): array
    {
        // Get the current host - to compare against for internal links
        $manager = new Manager(new Cache(), new CurlHttpClient());
        $rules = $manager->getRules();

        $root_domain = $rules
            ->resolve(parse_url($this->currentURL(), PHP_URL_HOST))
            ->getRegistrableDomain();


        // Filter the array
        return array_values(array_filter(
            $this->links(),
            function ($link) use (&$root_domain, &$rules) {
                $link_root_domain = $rules
                    ->resolve(parse_url($link, PHP_URL_HOST))
                    ->getRegistrableDomain();

                return ($root_domain === $link_root_domain);
            }
        ));
    }

    /**
     * Get all external links on the page as absolute URLs
     *
     * @return array
     */
    public function externalLinks(): array
    {
        // Diff the array
        return array_diff(
            $this->links(),
            $this->internalLinks()
        );
    }

    /**
     * Get all links within the same sub-domain on the page as absolute URLs
     *
     * E.g.
     * www.example.com with a link to www.example.com/test would be found
     * www.example.com with a link to example.com/test would not be found
     *
     * @see internalLinks() and externalLinks() for more details
     *
     * @return array
     */
    public function subdomainLinks(): array
    {
        // Get the current host - to compare against for internal links
        $host = parse_url($this->currentURL(), PHP_URL_HOST);

        // Filter the array
        return array_values(array_filter(
            $this->links(),
            function ($link) use (&$host) {
                return ($host === parse_url($link, PHP_URL_HOST));
            }
        ));
    }

    /**
     * Get all links on the page with commonly interesting details
     *
     * @return array
     */
    public function linksWithDetails(): array
    {
        $links = $this->filter('//a');

        // Generate a list of all image entries
        $result = [];
        foreach ($links as $link) {
            // Generate the proper uri using the Symfony's link class
            $linkObj = new \Symfony\Component\DomCrawler\Link($link, $this->currentURL());

            // Check if the anchor is maybe only an image.
            $image = [];
            foreach($link->childNodes as $childNode) {
                if (!empty($childNode) && $childNode->nodeName === 'img') {
                    $image[] = (new \Symfony\Component\DomCrawler\Image($childNode, $this->currentURL()))->getUri();
                }
            }

            // Collect commonly interesting attributes and URL
            $rel = $link->getAttribute('rel');
            $entry = [
                'url' => $linkObj->getUri(),
                'text' => trim($link->nodeValue),
                'title' => $link->getAttribute('title') == '' ? null : $link->getAttribute('title'),
                'target' => $link->getAttribute('target') == '' ? null : $link->getAttribute('target'),
                'rel' => ($rel == '') ? null : strtolower($rel),
                'image' => $image,
                'isNofollow' => ($rel == '') ? false : (\strpos($rel, 'nofollow') !== false),
                'isUGC' => ($rel == '') ? false : (\strpos($rel, 'ugc') !== false),
                'isSponsored' => ($rel == '') ? false : (\strpos($rel, 'sponsored') !== false),
                'isMe' => ($rel == '') ? false : (\strpos($rel, 'me') !== false),
                'isNoopener' => ($rel == '') ? false : (\strpos($rel, 'noopener') !== false),
                'isNoreferrer' => ($rel == '') ? false : (\strpos($rel, 'noreferrer') !== false),
            ];

            $result[] = $entry;
        }

        return $result;
    }

    /**
     * Get all images on the page with absolute URLs
     *
     * @return array
     */
    public function images(): array
    {
        $images = $this->filter('//img')->images();

        // Generate a list of all image entries
        $result = [];
        foreach ($images as $image) {
            $result[] = $image->getUri();
        }

        return $result;
    }

    /**
     * Get all images on the page with commonly interesting details
     *
     * @return array
     */
    public function imagesWithDetails(): array
    {
        $images = $this->filter('//img');

        // Generate a list of all image entries
        $result = [];
        foreach ($images as $image) {
            // Generate the proper uri using the Symfony's image class
            $imageObj = new \Symfony\Component\DomCrawler\Image($image, $this->currentURL());

            // Collect commonly interesting attributes and URL
            $result[] = [
                'url' => $imageObj->getUri(),
                'alt' => $image->getAttribute('alt'),
                'width' => $image->getAttribute('width') == '' ? null : $image->getAttribute('width'),
                'height' => $image->getAttribute('height') == '' ? null : $image->getAttribute('height'),
            ];
        }

        return $result;
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
