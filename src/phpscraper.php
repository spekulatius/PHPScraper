<?php

// Namespace
namespace spekulatius;

// Libs used.
// https://github.com/FriendsOfPHP/Goutte
use Goutte\Client;

// https://github.com/jeremykendall/php-domain-parser
use Pdp\Cache;
use Pdp\CurlHttpClient;
use Pdp\Manager;

class phpscraper
{
    /**
     * holds the client
     *
     * @var spekulatius\core;
     */
    protected $core = null;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->core = new core();
    }

    /**
     * catch alls to properties and process them accordingly.
     *
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        // we are assuming that all calls for properties actually method calls...
        return $this->call($name);
    }

    /**
     * catches the method calls and tries to satisfy them.
     *
     * @param string $name
     * @param array $arguments = null
     * @return mixed
     */
    public function __call(string $name, array $arguments = null)
    {
        if ($name == 'call') {
            $name = $arguments[0];
            return $this->core->$name();
        } else {
            return $this->core->$name(...$arguments);
        }
    }
}

class core
{
    /**
     * holds the client
     *
     * @var Goutte\Client
     */
    protected $client = null;

    /**
     * holds the current page (a Crawler object)
     *
     * @var Symfony\Component\DomCrawler\Crawler
     */
    protected $current_page = null;

    /**
     * constructor
     */
    public function __construct()
    {
        // Goutte Client
        $this->client = new Client();

        // we assume that we want to follow any redirects.
        $this->client->followRedirects(true);
        $this->client->followMetaRefresh(true);
        $this->client->setMaxRedirects(5);

        // make ourselves known
        $this->client->setServerParameter(
            'HTTP_USER_AGENT',
            'PHP Scraper/0.x (https://phpscraper.de)'
        );
    }

    /**
     * returns the current url
     *
     * @return string $url
     */
    public function currentURL()
    {
        return $this->current_page->getUri();
    }

    /**
     * navigates to an url
     *
     * @param string $url
     */
    public function go(string $url)
    {
        $this->current_page = $this->client->request('GET', $url);
    }

    /**
     * fetch an asset from a given URL
     *
     * @param string $url
     */
    public function fetchAsset(string $url)
    {
        return $this->client->request('GET', $url)->getResponse();
    }

    /**
     * filters the current page by a parameter
     *
     * @param string $filter
     * @return Crawler
     */
    public function filter(string $query)
    {
        return $this->current_page->filterXPath($query);
    }

    /**
     * filters the current page by a parameter and returns the first one, or null.
     *
     * @param string $filter
     * @return Crawler|null
     */
    public function filterFirst(string $query)
    {
        $filtered = $this->filter($query);

        return ($filtered->count() == 0) ? null : $filtered->first();
    }

    /**
     * filters the current page by a parameter and returns the first ones content, or null.
     *
     * @param string $filter
     * @return string|null
     */
    public function filterFirstText(string $query)
    {
        $filtered = $this->filter($query);

        return ($filtered->count() == 0) ? null : $filtered->first()->text();
    }

    /**
     * filters the current page by a parameter and returns the first ones content, or null.
     *
     * @param string $filter
     * @param array $attributes
     * @return string|null
     */
    public function filterExtractAttributes(string $query, array $attributes)
    {
        $filtered = $this->filter($query);

        return ($filtered->count() == 0) ? [] : $filtered->extract($attributes);
    }

    /**
     * filters the current page by a parameter and returns the first ones content, or null.
     *
     * @param string $filter
     * @param array $attributes
     * @return string|null
     */
    public function filterFirstExtractAttribute(string $query, array $attributes)
    {
        $filtered = $this->filter($query);

        return ($filtered->count() == 0) ? null : $filtered->first()->extract($attributes)[0];
    }

    /**
     * returns the content attribute for the first result of the query, or null.
     *
     * @param string $filter
     * @return string|null
     */
    public function filterFirstContent(string $query)
    {
        return $this->filterFirstExtractAttribute($query, ['content']);
    }

    /**
     * Access conviences: Methods, to access data easier.
     *
     * I like to have direct access to stuff without many chained calls.
     * So I've added a number of things which might be of interest.
     *
     * Any suggestions what is missing? Send a PR :)
     *
     * @see https://phpscraper.de/contributing
     */

    /**
     * get the title
     *
     * @return string
     */
    public function title()
    {
        return $this->filterFirstText('//title');
    }

    /**
     * get the charset
     *
     * @return string
     */
    public function charset()
    {
        // a bit more complex, as I didn't get the XPath working proper...
        $filteredList = array_values(array_filter(
            // 1. Get all attributes "charset"
            $this->filter('//meta')->extract(['charset']),

            // 2. filter empty ones out.
            function ($charset) {
                return $charset == '';
            },
            ARRAY_FILTER_USE_KEY
        ));

        return count($filteredList) == 0 ? null : $filteredList[0];
    }

    /**
     * get the content-type
     *
     * @return string
     */
    public function contentType()
    {
        return $this->filterFirstExtractAttribute('//meta[@http-equiv="Content-type"]', ['content']);
    }

    /**
     * get the canonical
     *
     * @return string
     */
    public function canonical()
    {
        return $this->filterFirstExtractAttribute('//link[@rel="canonical"]', ['href']);
    }

    /**
     * get the viewport as a string
     *
     * @return string
     */
    public function viewportString()
    {
        return $this->filterFirstContent('//meta[@name="viewport"]');
    }

    /**
     * get the viewport as an array
     *
     * @return array
     */
    public function viewport()
    {
        return \preg_split('/,\s*/', $this->viewportString());
    }

    /**
     * get the csrfToken
     *
     * @return string
     */
    public function csrfToken()
    {
        return $this->filterFirstExtractAttribute('//meta[@name="csrf-token"]', ['content']);
    }

    /**
     * get the header collected as an array
     *
     * @return array
     */
    public function headers()
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
     * get the author
     *
     * @return string
     */
    public function author()
    {
        return $this->filterFirstContent('//meta[@name="author"]');
    }

    /**
     * get the image
     *
     * @return string
     */
    public function image()
    {
        return $this->filterFirstContent('//meta[@name="image"]');
    }

    /**
     * get the keyword as a string
     *
     * @return string
     */
    public function keywordString()
    {
        return $this->filterFirstContent('//meta[@name="keywords"]');
    }

    /**
     * get the keyword as an array
     *
     * @return array
     */
    public function keywords()
    {
        return \preg_split('/,\s*/', $this->keywordString());
    }

    /**
     * get the description
     *
     * @return string
     */
    public function description()
    {
        return $this->filterFirstContent('//meta[@name="description"]');
    }

    /**
     * get the meta collected as an array
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
     * gets the open graph attributes as an array
     *
     * @return array
     */
    public function twitterCard()
    {
        $data = $this
            ->filter('//meta[contains(@name, "twitter:")]')
            ->extract(['name', 'content']);

        // prepare the data
        $result = [];
        foreach ($data as $set) {
            $result[$set[0]] = $set[1];
        }

        return $result;
    }

    /**
     * gets the open graph attributes as an array
     *
     * @return array
     */
    public function openGraph()
    {
        $data = $this
            ->filter('//meta[contains(@property, "og:")]')
            ->extract(['property', 'content']);

        // prepare the data
        $result = [];
        foreach ($data as $set) {
            $result[$set[0]] = $set[1];
        }

        return $result;
    }

    /**
     * get all <h1> tags (should be usually only one)
     *
     * @return array
     */
    public function h1()
    {
        return $this->filterExtractAttributes('//h1', ['_text']);
    }

    /**
     * get all <h2> tags
     *
     * @return array
     */
    public function h2()
    {
        return $this->filterExtractAttributes('//h2', ['_text']);
    }

    /**
     * get all <h3> tags
     *
     * @return array
     */
    public function h3()
    {
        return $this->filterExtractAttributes('//h3', ['_text']);
    }

    /**
     * get all <h4> tags
     *
     * @return array
     */
    public function h4()
    {
        return $this->filterExtractAttributes('//h4', ['_text']);
    }

    /**
     * get all <h5> tags
     *
     * @return array
     */
    public function h5()
    {
        return $this->filterExtractAttributes('//h5', ['_text']);
    }

    /**
     * get all <h6> tags
     *
     * @return array
     */
    public function h6()
    {
        return $this->filterExtractAttributes('//h6', ['_text']);
    }

    /**
     * get all heading tags
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
     * get all paragraphs of the page
     *
     * @return array
     */
    public function paragraphs()
    {
        return $this->filterExtractAttributes('//p', ['_text']);
    }

    /**
     * get the paragraphs of the page excluding empty paragraphs.
     *
     * @return array
     */
    public function cleanParagraphs()
    {
        return array_values(array_filter(
            $this->paragraphs(),
            function($paragraph) { return ($paragraph != ''); }
        ));
    }

    /**
     * parses the content outline of the web-page
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
     * parses the content outline of the web-page
     *
     * @return array
     */
    public function outlineWithParagraphs()
    {
        $result = $this->filterExtractAttributes('//h1|//h2|//h3|//h4|//h5|//h6|//p', ['_name', '_text']);

        foreach ($result as $index => $array) {
            $result[$index] = array_combine(['tag', 'content'], $array);
        }

        return $result;
    }

    /**
     * parses the content outline of the web-page
     *
     * @return array
     */
    public function cleanOutlineWithParagraphs()
    {
        $result = $this->filterExtractAttributes('//h1|//h2|//h3|//h4|//h5|//h6|//p', ['_name', '_text']);

        foreach ($result as $index => $array) {
            if ($array[1] !== '') {
                $result[$index] = array_combine(['tag', 'content'], $array);
            }
        }

        return $result;
    }

    /**
     * get all links on the page as absolute URLs
     *
     * @return array
     */
    public function links()
    {
        $links = $this->filter('//a')->links();

        // generate a list of all image entries
        $result = [];
        foreach ($links as $link) {
            $result[] = $link->getUri();
        }

        return $result;
    }

    /**
     * get all internal links (same root or sub-domain) on the page as absolute URLs
     *
     * @return array
     */
    public function internalLinks()
    {
        // get the current host - to compare against for internal links
        $manager = new Manager(new Cache(), new CurlHttpClient());
        $rules = $manager->getRules();

        $root_domain = $rules
            ->resolve(parse_url($this->currentURL(), PHP_URL_HOST))
            ->getRegistrableDomain();


        // filter the array
        return array_values(array_filter(
            $this->links(),
            function($link) use (&$root_domain, &$rules) {
                $link_root_domain = $rules
                    ->resolve(parse_url($link, PHP_URL_HOST))
                    ->getRegistrableDomain();

                return ($root_domain === $link_root_domain);
            }
        ));
    }

    /**
     * get all external links on the page as absolute URLs
     *
     * @return array
     */
    public function externalLinks()
    {
        // diff the array
        return array_diff(
            $this->links(),
            $this->internalLinks()
        );
    }

    /**
     * get all links within the same sub-domain on the page as absolute URLs
     *
     * E.g.
     * www.example.com with a link to www.example.com/test would be found
     * www.example.com with a link to example.com/test would not be found
     *
     * @see internalLinks() and externalLinks() for more details
     *
     * @return array
     */
    public function subdomainLinks()
    {
        // get the current host - to compare against for internal links
        $host = parse_url($this->currentURL(), PHP_URL_HOST);

        // filter the array
        return array_values(array_filter(
            $this->links(),
            function($link) use (&$host) { return ($host === parse_url($link, PHP_URL_HOST)); }
        ));
    }

    /**
     * get all links on the page with commonly interesting details
     *
     * @return array
     */
    public function linksWithDetails()
    {
        $links = $this->filter('//a');

        // generate a list of all image entries
        $result = [];
        foreach ($links as $link) {
            // generate the proper uri using the Symfony's link class
            $linkObj = new \Symfony\Component\DomCrawler\Link($link, $this->currentURL());

            // collect commonly interesting attributes and URL
            $entry = [
                'url' => $linkObj->getUri(),
                'text' => $link->nodeValue,
                'title' => $link->getAttribute('title') == '' ? null : $link->getAttribute('title'),
                'target' => $link->getAttribute('target') == '' ? null : $link->getAttribute('target'),
                'rel' => $link->getAttribute('rel') == '' ? null : strtolower($link->getAttribute('rel')),
            ];

            // add additional parameters in for "rel"
            $entry['isNofollow'] = \strpos($entry['rel'], 'nofollow') !== false;
            $entry['isUGC'] = \strpos($entry['rel'], 'ugc') !== false;
            $entry['isNoopener'] = \strpos($entry['rel'], 'noopener') !== false;
            $entry['isNoreferrer'] = \strpos($entry['rel'], 'noreferrer') !== false;

            $result[] = $entry;
        }

        return $result;
    }

    /**
     * get all images on the page with absolute URLs
     *
     * @return array
     */
    public function images()
    {
        $images = $this->filter('//img')->images();

        // generate a list of all image entries
        $result = [];
        foreach ($images as $image) {
            $result[] = $image->getUri();
        }

        return $result;
    }

    /**
     * get all images on the page with commonly interesting details
     *
     * @return array
     */
    public function imagesWithDetails()
    {
        $images = $this->filter('//img');

        // generate a list of all image entries
        $result = [];
        foreach ($images as $image) {
            // generate the proper uri using the Symfony's image class
            $imageObj = new \Symfony\Component\DomCrawler\Image($image, $this->currentURL());

            // collect commonly interesting attributes and URL
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
     * click a link (either with title or url)
     *
     * @param string $title_or_url
     * @return boolean
     */
    public function clickLink($title_or_url)
    {
        // if the string starts with http just go to it - we assume it's an URL
        if (\stripos($title_or_url, 'http') === 0) {
            // go to a URL
            $this->go($title_or_url);

            return true;
        } else {
            // find link based on the title
            $link = $this->current_page->selectLink($title_or_url)->link();

            // click the link and store the DOMCrawler object
            $this->current_page = $this->client->click($link);

            return true;
        }

        return false;
    }
}
