<p align="center">
  <a href="https://github.com/spekulatius/PHPScraper">
    <picture style="width: 100%;" alt="PHP Scraper: a web utility for PHP">
      <source srcset="https://github.com/spekulatius/phpscraper-docs/blob/master/.vuepress/public/logo-dark.png" media="(prefers-color-scheme:dark)">
      <img src="https://github.com/spekulatius/phpscraper-docs/blob/master/.vuepress/public/logo-light.png" alt="PHP Scraper: a web utility for PHP">
    </picture>
  </a>
  <p align="center">
    <a href="https://github.com/spekulatius/PHPScraper/actions/workflows/test.yaml">
      <img src="https://github.com/spekulatius/PHPScraper/actions/workflows/test.yaml/badge.svg" alt="Unit Tests">
    </a>
    <a href="https://packagist.org/packages/spekulatius/PHPScraper">
      <img src="https://poser.pugx.org/spekulatius/PHPScraper/d/total.svg" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/spekulatius/PHPScraper">
      <img src="https://poser.pugx.org/spekulatius/PHPScraper/v/stable.svg" alt="Latest Version">
    </a>
    <a href="https://packagist.org/packages/spekulatius/PHPScraper">
      <img src="https://poser.pugx.org/spekulatius/PHPScraper/license.svg" alt="License">
    </a>
  </p>
  <p align="center">
    <strong>For full documentation, visit <a href="https://phpscraper.de">phpscraper.de</a></strong>.
  </p>
</p>

PHPScraper is a versatile web-utility for PHP. Its primary objective is to streamline the process of extracting information from websites, allowing you to focus on accomplishing tasks without getting caught up in the complexities of selectors, data structure preparation, and conversion.

Under the hood, it uses

- [BrowserKit](https://symfony.com/doc/current/components/browser_kit.html) (formerly [Goutte](https://github.com/FriendsOfPHP/Goutte)) to access the web
- [League/URI](https://github.com/thephpleague/uri) to process URLs
- [donatello-za/rake-php-plus](https://github.com/donatello-za/rake-php-plus) to extract and analyze keywords

See [composer.json](https://github.com/spekulatius/PHPScraper/blob/master/composer.json) for more details.


:timer_clock: PHPScraper in 5 Minutes explained
-----------------------------------------------

Here are a few impressions of the way the library works. More examples are on the [project website](https://phpscraper.de/examples/scrape-website-title.html).

### Basics: Flexible Calling as an Attribute or Method

All scraping functionality can be accessed either as a function call or a property call. For example, the title can be accessed in two ways:

```php
// Prep
$web = new \Spekulatius\PHPScraper\PHPScraper;
$web->go('https://google.com');

// Returns "Google"
echo $web->title;

// Also returns "Google"
echo $web->title();
```

### :battery: Batteries included: Meta data, Links, Images, Headings, Content, Keywords, ...

Many common use cases are covered already. You can find prepared extractors for various HTML tags, including interesting attributes. You can filter and combine these to your needs. In some cases there is an option to get a simple or detailed version, here in the case of `linksWithDetails`:

```PHP
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Contains:
// <a href="https://placekitten.com/456/500" rel="ugc">
//   <img src="https://placekitten.com/456/400">
//   <img src="https://placekitten.com/456/300">
// </a>
$web->go('https://test-pages.phpscraper.de/links/image-urls.html');

// Get the first link on the page and print the result
print_r($web->linksWithDetails[0]);
// [
//     'url' => 'https://placekitten.com/456/500',
//     'protocol' => 'https',
//     'text' => '',
//     'title' => null,
//     'target' => null,
//     'rel' => 'ugc',
//     'image' => [
//         'https://placekitten.com/456/400',
//         'https://placekitten.com/456/300'
//     ],
//     'isNofollow' => false,
//     'isUGC' => true,
//     'isSponsored' => false,
//     'isMe' => false,
//     'isNoopener' => false,
//     'isNoreferrer' => false,
// ]
```

If there aren't any matching elements (here links) on the page, an empty array will be returned. If a method normally returns a string it might return `null`. Details such as `follow_redirects`, etc. are optional configuration parameters (see below).

Most of the DOM should be covered using these methods:

- several [meta-tags](https://phpscraper.de/examples/scrape-meta-tags.html) and other [`<head>`-information](https://phpscraper.de/examples/scrape-header-tags.html)
- [Social-Media information](https://phpscraper.de/examples/scrape-social-media-meta-tags.html) like Twitter Card and Facebook Open Graph
- Content: [Headings](https://phpscraper.de/examples/headings.html), [Outline](https://phpscraper.de/examples/outline.html), [Texts](https://phpscraper.de/examples/paragraphs.html) and [Lists](https://phpscraper.de/examples/lists.html)
- [Images](https://phpscraper.de/examples/scrape-images.html)
- [Links](https://phpscraper.de/examples/scrape-links.html)
- [Keywords](https://phpscraper.de/examples/extract-keywords.html)

 **A full list of methods with example code can be found on [phpscraper.de](https://phpscraper.de). Further examples are in the [tests](https://github.com/spekulatius/PHPScraper/tree/master/tests).**


### Download Files

Besides processing the content on the page itself, you can download files using `fetchAsset`:

```php
// Absolute URL
$csvString = $web->fetchAsset('https://test-pages.phpscraper.de/test.csv');

// Relative URL after navigation
$csvString = $web
  ->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html')
  ->fetchAsset('/test.csv');
```

You will only need to write the content into a file or cloud storage.


### Process the RSS feeds, `sitemap.xml`, etc.

PHPScraper can assist in collecting feeds such as [RSS feeds, `sitemap.xml`-entries and static search indexes](https://phpscraper.de/examples/scrape-feeds.html). This can be useful when deciding on the next page to crawl or building up a list of pages on a website.

Here we are processing the sitemap into a set of [`FeedEntry`-DTOs](https://github.com/spekulatius/PHPScraper/blob/master/src/DataTransferObjects/FeedEntry.php):

```php
(new \Spekulatius\PHPScraper\PHPScraper)
    ->go('https://phpscraper.de')
    ->sitemap

// array(131) {
//   [0]=>
//   object(Spekulatius\PHPScraper\DataTransferObjects\FeedEntry)#165 (3) {
//     ["title"]=>
//     string(0) ""
//     ["description"]=>
//     string(0) ""
//     ["link"]=>
//     string(22) "https://phpscraper.de/"
//   }
//   [1]=>
// ...
```

Whenever post-processing is applied, you can fall back to the underlying `*Raw`-methods.


### Process CSV-, XML- and JSON files and URLs

PHPScraper comes out of the box with file / URL processing methods for CSV-, XML- and JSON:

- `parseJson`
- `parseXml`
- `parseCsv`
- `parseCsvWithHeader` (generates an asso. array using the first row)

Each method can process both strings as well as URLs:

```php
// Parse JSON into array:
$json = $web->parseJson('[{"title": "PHP Scraper: a web utility for PHP", "url": "https://phpscraper.de"}]');
// [
//     'title' => 'PHP Scraper: a web utility for PHP',
//     'url' => 'https://phpscraper.de'
// ]

// Fetch and parse CSV into a simple array:
$csv = $web->parseCsv('https://test-pages.phpscraper.de/test.csv');
// [
//     ['date', 'value'],
//     ['1945-02-06', 4.20],
//     ['1952-03-11', 42],
// ]

// Fetch and parse CSV with first row as header into an asso. array structure:
$csv = $web->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv');
// [
//     ['date' => '1945-02-06', 'value' => 4.20],
//     ['date' => '1952-03-11', 'value' => 42],
// ]
```

Additional CSV parsing parameters such as separator, enclosure and escape are possible.


### There is more!

There are plenty of examples on the [PHPScraper website](https://phpscraper.de) and in the [tests](https://github.com/spekulatius/PHPScraper/tree/master/tests).

Check the [`playground.php`](https://github.com/spekulatius/PHPScraper/blob/master/playground.php) if you prefer learning by doing. You get it up and running with:

```bash
$ git clone git@github.com:spekulatius/PHPScraper.git && composer update
```

:muscle: Roadmap
----------------

The future development is organized into [milestones](https://github.com/spekulatius/PHPScraper/milestones?direction=asc&sort=title). Releases follow [semver](https://semver.org/).

### v1: [Building the first stable version](https://github.com/spekulatius/PHPScraper/milestone/4?closed=1)

- Improve documentation and examples.
- Organize code better (move websites into separate repos, etc.)
- Add support for feeds and some typical file types.

### v2: Service Upgrade:

- Switch from Goutte to [Symfony BrowserKit](https://symfony.com/doc/current/components/browser_kit.html). Goutte has been archived.

### v3: [Expand the functionality and cover more 'types'](https://github.com/spekulatius/PHPScraper/milestone/5)

- Expand to parse a wider range of types, elements, embeds, etc.
- Improve performance with caching and concurrent fetching of assets
- Minor improvements for parsing methods

### v4: [Expand to provide more guidance on building custom scrapers on top of PHPScraper](https://github.com/spekulatius/PHPScraper/milestone/6)

TBC.


:heart_eyes: Sponsors
---------------------

PHPScraper is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

With your support, PHPScraper can became the *PHP swiss army knife for the web*. If you find PHPScraper useful to your work, please consider a [sponsorship](https://github.com/sponsors/spekulatius) or [donation](https://www.buymeacoffee.com/spekulatius). Thank you :muscle:


:gear: Configuration (optional)
-------------------------------

If needed, you can use the following configuration options:

### User Agent

You can set the browser agent using `setConfig`:

```php
$web->setConfig([
  'agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/107.0'
]);
```

It defaults to `Mozilla/5.0 (compatible; PHP Scraper/1.x; +https://phpscraper.de)`.

### Proxy Support

You can configure proxy support with `setConfig`:

```php
$web->setConfig(['proxy' => 'http://user:password@127.0.0.1:3128']);
```

### Timeout

You can set the `timeout` using `setConfig`:

```php
$web->setConfig(['timeout' => 15]);
```

Setting the timeout to zero will disable it.

### Disabling SSL

While unrecommended, it might be required to disable SSL checks. You can do so using:

```php
$web->setConfig(['disable_ssl' => true]);
```

You can call `setConfig` multiple times. It stores the config and merges it with previous settings. This should be kept in mind in the unlikely use-case when unsetting values.


:rocket: Installation with Composer
-----------------------------------

```bash
composer require spekulatius/phpscraper
```

After the installation, the package will be picked up by the Composer autoloader. If you are using a common PHP application or framework such as Laravel or Symfony you can start scraping now :rocket:

If not or you are building a standalone-scraper, please include the autoloader in `vendor/` at the top of your file:

```php
<?php

require __DIR__ . '/vendor/autoload.php';

// ...
```

Now you can now use any of the examples on the documentation website or from the [`tests/`-folder](https://github.com/spekulatius/PHPScraper/tree/master/tests).

Please consider supporting PHPScraper with a star or [sponsorship](https://github.com/sponsors/spekulatius):

```bash
composer thanks
```

Thank you :muscle:


:white_check_mark: Testing
--------------------------

The library comes with a PHPUnit test suite. To run the tests, run the following command from the project folder:

```bash
composer test
```

You can find the tests [here](https://github.com/spekulatius/PHPScraper/tree/master/tests). The test pages are [publicly available](https://github.com/spekulatius/phpscraper-test-pages).

## MISC: [Issues](https://github.com/spekulatius/PHPScraper/issues), [Ideas](https://github.com/spekulatius/PHPScraper/milestones), [Contributing](https://github.com/spekulatius/PHPScraper/blob/master/CONTRIBUTING.md), [CHANGELOG](https://github.com/spekulatius/PHPScraper/blob/master/CHANGELOG.md), [UPGRADING](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md), [LICENSE](https://github.com/spekulatius/PHPScraper/blob/master/LICENSE.md)
