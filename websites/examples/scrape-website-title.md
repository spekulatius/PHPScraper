---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Website%20Title&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Website Title

Scraping the title from a website is simple. The following examples show how it works using PHPScraper.


## Simple Example

Very simple example of how to scrape the title of a website:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Navigate to the test page - this one does contain a title-tag "Lorem Ipsum"
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Contains:
 *
 * <title>Lorem Ipsum</title>
 */

// Fetch the title. This will return: "Lorem Ipsum"
var_dump($web->title);
```


## Missing Title

`null` will be returned if the title is missing:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Navigate to the test page - this one doesn't contain a title-tag.
$web->go('https://test-pages.phpscraper.de/meta/missing.html');

// Fetch the title. This will return null.
var_dump($web->title);
```

Note: This is the default behaviour: If a tag wasn't found because it's missing in the source HTML, `null` will be returned. If an iteratable item is empty (e.g. scraping images from a page without images), an empty array will be returned.


## Special Characters

Load a website title with German Umlaute

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

/**
 * Navigate to the test page. It contains:
 *
 * <title>A page with plenty of German umlaute everywhere (ä ü ö)</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

// Print the title: "A page with plenty of German umlaute everywhere (ä ü ö)"
echo $web->title;
```

It should work similarly with any UTF-8 characters.


## HTML Entities

HTML Entities should be resolved

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

/**
 * Navigate to the test page. Contains:
 *
 * <title>Cat &amp; Mouse</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

// Print the title: "Cat & Mouse"
echo $web->title;
```

::: tip
Entities and special characters have been considered throughout the library. If you find a place where these don't work as expected, please raise an [issue](https://github.com/spekulatius/PHPScraper/issues).
:::
