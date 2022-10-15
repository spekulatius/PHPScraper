---
image: https://api.imageee.com/bold?text=PHP%20Scraper:%20Bringing%20Simplicity%20back%20to%20Scraping%20and%20Crawling&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

PHP Scraper: Bringing Simplicity back to Scraping and Crawling
==============================================================

![PHP Scraper: Bringing Simplicity back to Scraping and Crawling](logo-light.png)

*by [Peter Thaleikis](https://peterthaleikis.com)*

PHPScraper is a scraper library for PHP, built with simplicity in mind. This is an opinionated wrapper around some great PHP libraries to make accessing the web easier.

The examples tell the story much better. Have a look!


The Idea 💡️
----------

Accessing websites and collecting basic information of the web is too complex. This wrapper around [Goutte](https://github.com/FriendsOfPHP/Goutte) makes it easier. It saves you from XPath and co., giving you direct access to everything you need. Web scraping with PHP re-imagined.


Supporters 💪️
-------------

This project is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Want to sponsor this project? [Write me](https://peterthaleikis.com/contact).


Some Examples
-------------

Here are some examples of what the web scraping library can do at this point:

### Scrape Meta Information:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Get the information:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```

Nearly any information can be accessed directly, either as string or an array.


### Scrape Content, such as Images:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page. This page contains two images:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
/**
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

Some information *optionally* is returned as an array with details. For this example, a simple list of images is available using `$web->images` too. This should make your web scraping easier.

More example code can be found in the examples and tests.


Installation
------------

The installation usually is done using [Composer](https://getcomposer.org).

### Installation with Composer

```bash
composer require spekulatius/phpscraper
```

After the installation is completed the package will be picked up by the Composer autoloader. In typical PHP applications and frameworks such as Laravel or Symfony you can start scraping now. You can now use any of the noted examples or examples in the `tests/`-folder.

Please consider supporting PHPScraper with a star or [sponsorship](https://github.com/sponsors/spekulatius):

```bash
composer thanks
```

### Usage in VanillaPHP-Projects

If you are building a VanillaPHP project, you will need to include the autoloader in your script at the top of your PHP script:

```php
require 'vendor/autoload.php';
```

If you are using a framework such as Laravel, Symfony, Laminas, Phalcon, or CakePHP, you won't need this step. The autoloader is automatically included.


Configuration
-------------

Further configuration is optional. Below are the correctly available options.

### Proxy Support

If you require proxies, you can configure the proxy support with `setConfig`:

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


Found a bug and fixed it? Awesome!
----------------------------------

Before you get started, make yourself familiar with the [contribution guidelines](/contributing.html). Any questions feel free to reach out.


Tests: Making sure it works!
----------------------------

The code is roughly covered with end-to-end tests. For this, simple web-pages are hosted under *https://test-pages.phpscraper.de/*, loaded and parsed using [PHPUnit](https://phpunit.de/). These tests are also suitable as examples - see `tests/`!

This being said, there are probably edge cases which aren't working and may cause trouble. If you find one, please raise a bug on GitHub.
