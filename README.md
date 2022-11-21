# [PHP Scraper - a web utility for PHP](https://github.com/spekulatius/PHPScraper)

<p align="center">
  <picture style="width: 100%;">
    <source srcset="websites/.vuepress/public/logo-dark.png" media="(prefers-color-scheme:dark)">
    <img src="websites/.vuepress/public/logo-light.png">
  </picture>
</p>

PHPScraper is a universal web-util for PHP. The main goal is to get stuff done instead of getting distracted with selectors, preparing & converting data structures, etc. Instead, you can just *"go to a website"* and get the relevant information for your project.

Under the hood, it uses

- [Goutte](https://github.com/FriendsOfPHP/Goutte) to access the web,
- [League/URI](https://github.com/thephpleague/uri) to process URL.
- [donatello-za/rake-php-plus](https://github.com/donatello-za/rake-php-plus) to extract and analyse keywords.

See [composer.json](https://github.com/spekulatius/PHPScraper/blob/master/composer.json) for details.


:timer_clock: 5 Minutes Tutorial: The Basics Explained with Examples
--------------------------------------------------------------------

Here are a few impressions of the way the library works. More examples are on the [project website](https://phpscraper.de/examples/scrape-website-title.html).

### Basics: Flexible Calling as Attribute or Method

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

### Common Use-Cases: Headings, Content, Links, Images, etc. pp.

Many common use-cases are covered already. You can find extractors for various HTML tags including attributes of interest. Sometimes there is an option to get a simple and a details version, here in the case of links:

```PHP
$web = new \spekulatius\phpscraper;

// Contains `<a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>`
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Get the first link on the page and print the result
print_r($web->linksWithDetails[0]);
// [
//     'url' => 'https://placekitten.com/432/287',
//     'protocol' => 'https',
//     'text' => 'external kitten',
//     'title' => null,
//     'target' => null,
//     'rel' => 'nofollow',
//     'isNofollow' => true,
//     'isUGC' => false,
//     'isNoopener' => false,
//     'isNoreferrer' => false,
// ]
```

Details such as follow_redirects, etc. are optional configuration parameters (see below).

It's also tested. The test-pages are available as GitHub repo.






If there aren't any matching elements (here links) on the page, an empty array will be returned.

### Scrape the Images from a Website

Scraping the images including the attributes of the `img`-tags:

```php
// Prep
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page.
 *
 * This page contains twice the image "cat.jpg".
 * Once with a relative path and once with an absolute path.
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
/**
 * Contains:
 *
 * [
 *     'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'alt' => 'absolute path',
 *     'width' => null,
 *     'height' => null,
 * ],
 * [
 *     'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'alt' => 'relative path',
 *     'width' => null,
 *     'height' => null,
 * ]
 */
```


### There is more!

There are plenty of examples on the [PHPScraper website](https://phpscraper.de) and in the [tests](https://github.com/spekulatius/PHPScraper/tree/master/tests).

If you prefer learning-by-doing check the [`playground.php`](https://github.com/spekulatius/PHPScraper/blob/master/playground.php) out. You get it up and running with:

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


Sponsors
--------

PHPScraper is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

If you find PHPScraper useful to your work or simply want to support the development, please consider a [sponsorship](https://github.com/sponsors/spekulatius) or [donation](https://www.buymeacoffee.com/spekulatius). Thank you :muscle:


:gear: Configuration
--------------------

While completely optional, you can use the following configuration options if needed:

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

### Agent

Add


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
```

Now you can now use any of the examples on the documentation website or from the [`tests/`-folder](https://github.com/spekulatius/PHPScraper/tree/master/tests).

Please consider supporting PHPScraper with a star or [sponsorship](https://github.com/sponsors/spekulatius):

```bash
composer thanks
```

Thank you :muscle:


:white_check_mark: Testing
--------------------------

The library comes with a PHPUnit test suite. You can find the tests [here](https://github.com/spekulatius/PHPScraper/tree/master/tests). The test pages are [publicly available](https://github.com/spekulatius/phpscraper-test-pages).

To run the tests, run the following command from the project folder.

```bash
composer test
```

## MISC: [Issues](https://github.com/spekulatius/PHPScraper/issues), [Ideas](https://github.com/spekulatius/PHPScraper/milestones), [Contributing](https://github.com/spekulatius/PHPScraper/blob/master/CONTRIBUTING.md), [CHANGELOG](https://github.com/spekulatius/PHPScraper/blob/master/CHANGELOG.md), [UPGRADING](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md), [LICENSE](https://github.com/spekulatius/PHPScraper/blob/master/LICENSE.md)
