---
image: https://api.imageee.com/bold?text=PHPScraper:%20Scraping%20Custom%20Elements&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Custom xPath Selectors

While PHP Scraper supports various simple and xPath-free options to access content you are free to use xPath selectors.

The following examples of custom selectors should be seen as a starting point for any custom information you need to scrape.

::: tip
If you are struggling with xPath, you might find [this cheatsheet](https://devhints.io/xpath) useful.
:::


## Select an element using the ID attribute

The following example shows how to use an xPath selector with an ID. The result will be the text of the element via `->text()`:

```php
// Init and load the test page.
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/content/selectors.html');

// Select `->text()` using an ID.
echo $web->filter("//*[@id='by-id']")->text();   // "Content by ID"
```

::: tip
This example uses `->text()` to get the textual content. You can also sub-select items on the same [html5](https://github.com/Masterminds/html5-php) element.
:::


## Select elements by tag name

Selecting elements by tags is shown below. The result will be an array containing the text of the elements:

```php
// Init and load the test page.
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/content/selectors.html');

// Filter using the ID
echo $web->filter("//h1")->text();          // "Selector Tests (h1)"

// Select single string using first and chain `->text()`
echo $web->filterFirst("//h1")->text();     // 'Selector Tests (h1)'

// Select as array using `filterTexts`:
echo $web->filterTexts("//h1");             // ['Selector Tests (h1)']
```

::: tip
While SEO best practices recommend having only one `<h1>`-tag per page, it is still technically possible to have multiple. To ensure you are able to scrap any number of headings this method will return a list instead of a string.
:::


## Select elements using a CSS class

Using a CSS class to select elements is, of course, possible too. Similarly to the tag selection, the result will be an array containing the text of the elements:

```php
// Init and load the test page.
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/content/selectors.html');

// Filter using the CSS class
echo $web->filter("//*[@class='by-class']");   // "Selector Tests"
```

## Troubleshooting

When using custom selectors, PHPScraper hands you the full power of Guotte. You will also receive all errors directly from Guotte instead of PHPScraper (for now).

Below are some common errors while working with custom xPaths:

### `PHP Fatal error: Uncaught InvalidArgumentException: The current node list is empty.`

This will happen if your current selection is empty: No element was found matching your query. You might need to adjust your query to select elements.

### `PHP Warning: DOMXPath::query(): Invalid expression`

This means your xPath is incorrect. Usually, this error occurs in `vendor/symfony/dom-crawler/Crawler.php on line 919`.

Make sure to format the xPath query correctly. The examples above show the required format, including the Asterix: `//*[...]`.
