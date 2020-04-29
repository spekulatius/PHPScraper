# Scraping a Website Title

Scraping the title from a website is simple. See the following examples to see how it works.


## Simple Example

Very simple example on how to scrape the title of an website:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page - this one doesn't contain a title-tag.
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Contains:
 *
 * <title>Lorem Ipsum</title>
 */

// Fetch the title. This should return:
// "Lorem Ipsum"
var_dump($web->title);
```


## Missing Title

If the title is missing `null` will be returned:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page - this one doesn't contain a title-tag.
$web->go('https://test-pages.phpscraper.de/meta/missing.html');

// Fetch the title. This should return null.
var_dump($web->title);
```

::: tip Default behaviour if nothing is found
This is the default behaviour: If a tag wasn't found because it's missing in the source HTML, `null` will be returned. If an iteratable item is empty (e.g. scraping images from a page without images), an empty array will be returned.
:::


## Special Characters

Load a website title with German Umlaute

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

/**
 * Contains:
 *
 * <title>A page with plenty of German umlaute everywhere (ä ü ö)</title>
 */

// Fetch the title. This should return:
// "A page with plenty of German umlaute everywhere (ä ü ö)"
echo $web->title;
```

It should work in similar manner with any UTF-8 characters.


## HTML Entities

HTML Entities should be solve

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

/**
 * Contains:
 *
 * <title>Cat &amp; Mouse</title>
 */

// Fetch the title. This should return:
// "Cat & Mouse'"
echo $web->title;
```
