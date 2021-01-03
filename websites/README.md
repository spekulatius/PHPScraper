---
image: https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

An *opinionated* web-scraping library for PHP
===========================================

*by [Peter Thaleikis](https://peterthaleikis.com)*

Accessing the web from PHP can done easier. This is an opinionated wrapper around some great libraries.

The examples tell the story much better. Have a look!


The Idea 💡️
----------

Accessing websites and collecting basic information of the web is too complex. This wrapper around [Goutte](https://github.com/FriendsOfPHP/Goutte) makes it easier. It saves you from XPath and co., giving you direct access to everything you need.


Supporters 💪️
-------------

This project is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Want to sponsor this project? [Contact me](https://peterthaleikis.com/contact).


Examples
--------

Here are some examples of what the library can do at this point:

### Scrape Meta Information:

```php
$web = new \spekulatius\phpscraper();

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

Most other information can be accessed directly - either as string or an array.


### Scrape Content, such as Images:

```PHP
$web = new \spekulatius\phpscraper();

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

Some information *optionally* is returned as an array with details. For this example, a simple list of images is available using `$web->images` too.

More example code can be found in the sidebar or the tests.


Installation
------------

As usual, done via composer:

```bash
composer require spekulatius/phpscraper
```

This automatically ensures the package is loaded. You can now use any of the above noted examples.


Contributing
------------

Awesome, if you would like contribute please check the [guidelines](/contributing) before getting started.


Tests
-----

The code is roughly covered with end-to-end tests. For this, simple web-pages are hosted under *https://test-pages.phpscraper.de/*, loaded and parsed using [PHPUnit](https://phpunit.de/). These tests are also suitable as examples - see `tests/`!

This being said, there are probably edge cases which aren't working and may cause trouble. If you find one, please raise a bug on GitHub.
