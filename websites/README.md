---
image: https://api.imageee.com/bold?text=PHP%20Scraper:%20a%20web%20utility%20for%20PHP&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

<center>PHP Scraper: a web utility for PHP</center>
==================================

<p align="center">
  <a href="https://github.com/spekulatius/PHPScraper">
    <img
        alt="PHP Scraper: Bringing Simplicity back to Scraping and Crawling"
        src="logo-light.png"
    />
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
    <strong>By <a href="https://peterthaleikis.com?src=phpscraper">Peter Thaleikis</a></strong>
  </p>
</p>

PHPScraper is a universal web-scraping util for PHP, built with simplicity in mind. The goal is to make xPath Selectors *optional* and avoid the commonly needed boilerplate code. Just create an instance of *PHPScraper*, *go* to a website, and start collecting data. The examples below tell the story much better. Have a look!

Under the hood, it uses

- [Goutte](https://github.com/FriendsOfPHP/Goutte) to access the web
- [League/URI](https://github.com/thephpleague/uri) to process URLs
- [donatello-za/rake-php-plus](https://github.com/donatello-za/rake-php-plus) to extract and analyze keywords

See [composer.json](https://github.com/spekulatius/PHPScraper/blob/master/composer.json) for more details.


:timer_clock: PHPScraper in 5 Minutes explained
-----------------------------------------------

Here are a few impressions of the way the library works. More examples are this website in the various sections.

### Basics: Flexible Calling as an Attribute or Method

All scraping functionality can be accessed either as a function call or a property call. For example, the title can be accessed in two ways:

```php
// Prep
$web = new \spekulatius\phpscraper;
$web->go('https://google.com');

// Returns "Google"
echo $web->title;

// Also returns "Google"
echo $web->title();
```

### :battery: Batteries included: Meta-Data, Links, Images, Headings, Content, Keywords, ...

Many common use cases are covered already. You can find prepared extractors for various HTML tags, including interesting attributes. You can filter and combine these to your needs. In some cases there is an option to get a simple or detailed version, here in the case of `linksWithDetails`:

```PHP
$web = new \spekulatius\phpscraper;

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

::: tip Null
If there aren't any matching elements (here links) on the page, an empty array will be returned.

For methods that normally return a single string (e.g. `title`), `null` will be returned in this case.
:::

Details such as `follow_redirects`, etc. are optional configuration parameters (see below).

Most of the DOM should be covered using these methods:

- several [meta-tags](/examples/scrape-meta-tags.html) and other [`<head>`-information](/examples/scrape-header-tags.html)
- [Social-Media information](/examples/scrape-social-media-meta-tags.html) like Twitter Card and Facebook Open Graph
- Content: [Headings](/examples/headings.html), [Outline](/examples/outline.html), [Texts](/examples/paragraphs.html) and [Lists](/examples/lists.html)
- [Keywords](/examples/extract-keywords.html)
- [Images](/examples/scrape-images.html) & [Links](/examples/scrape-links.html).

**More examples are included in the [tests](https://github.com/spekulatius/PHPScraper/tree/master/tests).**


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

::: warning 404s
If the intended URL isn't available an exception will be thrown. Make sure to handle this case by wrapping your code in a try-catch block:

```php
try {
    // ...
} catch (\Exception $e) {
    // ...
}
```
:::


### Process the RSS feeds, `sitemap.xml`, etc.

PHPScraper can assist in collecting feeds such as [RSS feeds, `sitemap.xml`-entries and static search indexes](/examples/scrape-feeds.html). This can be useful when deciding on the next page to crawl or build up a list of pages on a website.

Here we are processing the sitemap into a set of [`FeedEntry`-DTOs](https://github.com/spekulatius/PHPScraper/blob/pre-release-tweaks/src/DataTransferObjects/FeedEntry.php):

```php
(new \spekulatius\phpscraper)
    ->go('https://phpscraper.de')
    ->sitemap

// array(131) {
//   [0]=>
//   object(spekulatius\DataTransferObjects\FeedEntry)#165 (3) {
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

::: tip Fallback-Methods
Whenever post-processing is applied, you can fall back to the underlying `*Raw`-methods.
:::

### Process CSV-, XML- and JSON files and URLs

PHPScraper comes out-of-the-box with file / URL processing methods for CSV-, XML- and JSON:

- `parseJson`
- `parseXml`
- `parseCsv`
- `parseCsvWithHeader` (generates an asso. array using the first row)

Each method can process both strings as well as URLs:

```php
// Parse CSV into a simple array:
$csv = $web->parseJson('[{"title": "PHP Scraper: a web utility for PHP", "url": "https://phpscraper.de"}]');
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

::: tip Additional CSV parsing parameters
Additional CSV parsing parameters such as separator, enclosure and escape are possible.
:::


### There is more!

There are plenty of examples on the PHPScraper website and in the [tests](https://github.com/spekulatius/PHPScraper/tree/master/tests).

Check the [`playground.php`](https://github.com/spekulatius/PHPScraper/blob/master/playground.php) if you prefer learning by doing. You get it up and running with:

```bash
$ git clone git@github.com:spekulatius/PHPScraper.git && composer update
```

:muscle: Roadmap
----------------

The future development is organized into [milestones](https://github.com/spekulatius/PHPScraper/milestones?direction=asc&sort=title). Releases follow [semver](https://semver.org/).

### v1: [Building the first stable version](https://github.com/spekulatius/PHPScraper/milestone/4)

- Improve documentation and examples.
- Organize code better (move websites into separate repos, etc.)
- Add support for feeds and some typical file types.

### v2: [Expand the functionality and cover more 'types'](https://github.com/spekulatius/PHPScraper/milestone/5)

- Expand to parse a wider range of types, elements, embeds, etc.
- Improve performance with caching and concurrent fetching of assets
- Minor improvements for parsing methods

### v3: [Expand to provide more guidance on building custom scrapers on top of PHPScraper](https://github.com/spekulatius/PHPScraper/milestone/6)

TBC.


:heart_eyes: Sponsors
---------------------

PHPScraper is proudly supported by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

If you find PHPScraper useful to your work or simply want to support the development, please consider a [sponsorship](https://github.com/sponsors/spekulatius) or [donation](https://www.buymeacoffee.com/spekulatius). Thank you :muscle:


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

::: tip
If you're looking for decent prices residential proxy, check [IProyal](https://iproyal.com?r=119987).
:::

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

If you are using a framework such as Laravel, Symfony, Laminas, Phalcon, or CakePHP, you won't need this step. The autoloader is automatically included.
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

This being said, there are probably edge cases that aren't working and may cause trouble. If you find one, please raise a bug on GitHub.


:bug: Found a bug and fixed it? Awesome!
----------------------------------

Before you get started, make yourself familiar with the [contribution guidelines](/contributing.html). Feel free to reach out if questions come up.

## MISC:

- [Issues](https://github.com/spekulatius/PHPScraper/issues)
- [Ideas](https://github.com/spekulatius/PHPScraper/milestones)
- [Contributing](https://github.com/spekulatius/PHPScraper/blob/master/CONTRIBUTING.md)
- [CHANGELOG](https://github.com/spekulatius/PHPScraper/blob/master/CHANGELOG.md)
- [UPGRADING](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md)
- [LICENSE](https://github.com/spekulatius/PHPScraper/blob/master/LICENSE.md)
