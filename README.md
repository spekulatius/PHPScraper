# [PHP Scraper - a web utility for PHP](https://github.com/spekulatius/PHPScraper)

<p align="center">
  <picture style="width: 100%;">
    <source srcset="websites/.vuepress/public/logo-dark.png" media="(prefers-color-scheme:dark)">
    <img src="websites/.vuepress/public/logo-light.png">
  </picture>
</p>

PHPScraper is a universal web-util for PHP. The main goal is to get stuff done instead of getting distracted with selectors, preparing & converting data structures, etc. Instead, you can just *"go to a website"* and get all relevant details for your project.

Under the hood, it uses [Goutte](https://github.com/FriendsOfPHP/Goutte), [League/URI](https://github.com/thephpleague/uri) and a few other packages. See [composer.json](https://github.com/spekulatius/PHPScraper/blob/master/composer.json) for details.


Roadmap
-------

The future development is organized into milestones.

### v1: Building the stable base version.

- Improve documentation and examples.
- Organize code better (move websites into separate repos, etc.)

More Details: https://github.com/spekulatius/PHPScraper/milestone/4

### v2: Expand the functionality to cover more types

More Details: https://github.com/spekulatius/PHPScraper/milestone/5

### v3: Expand to provide more guidance on building custom scrapers on top of PHPScraper.

TBC.

If you want to support the development or looking for support with a custom feature, please consider a sponsorship or donation.


## Sponsors

This project is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Want to sponsor this project? [Contact me](https://peterthaleikis.com/contact).


## Examples

Here are a few impressions of the way the library works. More examples are on the [project website](https://phpscraper.de/examples/scrape-website-title.html).

### Basics: Get the Title of a Website

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

### Links

The following example shows how to collect links along with meta information:

```PHP
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page. This page contains several links with different rel attributes. To save space only the first one:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Get the first link on the page.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink contains now:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'protocol' => 'https',
 *     'text' => 'external kitten',
 *     'title' => null,
 *     'target' => null,
 *     'rel' => 'nofollow',
 *     'isNofollow' => true,
 *     'isUGC' => false,
 *     'isNoopener' => false,
 *     'isNoreferrer' => false,
 * ]
 */
```

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

## Configuration

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

You can call `setConfig` multiple times. It stores the config and merges it with previous settings. This should be kept in mind in the unlikely use-case when unsetting values.

See the full documentation on the website for more information and many more examples.


Installation
------------

[Composer](https://getcomposer.org) is used to install PHPScraper:

```bash
composer require spekulatius/phpscraper
```

After the installation, the package will be picked up by the Composer autoloader. You can start scraping now if you are using typical PHP applications or frameworks such as Laravel or Symfony. You can now use any of the examples on the website or examples in the [`tests/`-folder](https://github.com/spekulatius/PHPScraper/tree/master/tests).

Please consider supporting PHPScraper with a star or [sponsorship](https://github.com/sponsors/spekulatius):

```bash
composer thanks
```

Thank you :muscle:


Testing
-------

The library comes with a PHPUnit test suite. You can find the tests [here](https://github.com/spekulatius/PHPScraper/tree/master/tests).

To run the tests, run the following command from the project folder.

```bash
composer test
```

## MISC: [Current Issues](https://github.com/spekulatius/PHPScraper/issues) [Future Ideas](https://github.com/spekulatius/PHPScraper/milestones), [Contributing](https://github.com/spekulatius/PHPScraper/blob/master/CONTRIBUTING.md), [CHANGELOG](https://github.com/spekulatius/PHPScraper/blob/master/CHANGELOG.md), [UPGRADING](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md), [License](https://github.com/spekulatius/PHPScraper/blob/master/license.md)
