---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Common%20File%20Types&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape CSV, XML and JSON

PHPScraper can process common plain file types such as `csv`, `json`, `xml` from strings or URLs for you. Most functionality described below works for all three types. Special cases are noted. The following topics are covered:

[[toc]]


## Parsing of CSV/XML/JSON strings

If you have a string that represents a CSV, XML or JSON, PHPScraper can assist in validating and parsing it:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Parse a JSON string
$json = $web->parseJson($jsonString);

// Parse an XML string
$xml = $web->parseXml($xmlString);

// Parse a CSV string
$csv = $web->parseCsv($csvString);
```

This can be useful when chaining steps or accessing embedded elements such as schema data.


## Fetching and Parsing of CSV/XML/JSON URLs

PHPScraper can assist with fetching and parsing the contents of remote resources (URLs) containing JSON-, CSV- or XML data:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Fetches URL and parses contents to JSON.
$json = $web
    ->parseJson('https://test-pages.phpscraper.de/index.json');

// Fetches URL and parses contents to XML.
$xml = $web
    ->parseXml('https://test-pages.phpscraper.de/sitemap.xml');

// Fetches URL and parses contents into a simple array.
$csv = $web
    ->parseCsv('https://test-pages.phpscraper.de/test.csv');

// Fetches URL and generates an asso. array (map) with the first line as keys.
$csv = $web
    ->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv');
```

Each of the methods above can be accessed in various ways. Using `parseCsv` as an example, you can use any of the methods as following:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Option 1: Pass in the absolute URL
$csv = $web
    ->parseCsv('https://test-pages.phpscraper.de/test.csv');

// Option 2: Navigate to a relative URL for parsing.
$csv = $web
    ->go('https://test-pages.phpscraper.de/meta/feeds.html')
    ->parseCsv('/test.csv');

// Option 3: Navigate with `go` or `clickLink` and call the parser.
$csv = $web
    ->go('https://test-pages.phpscraper.de/test.csv')
    ->parseCsv();
```

::: tip Multiple Methods
The examples above apply to the following methods:

- `parseJson`
- `parseXml`
- `parseCsv`
- `parseCsvWithHeader` (resolves into an asso. array)
:::

## Parsing a CSV String with Headers

CSV can be parsed into various data structures. PHPScraper comes with two options built-in to parse CSV. Given the following example file:

```bash
$ curl https://test-pages.phpscraper.de/test.csv

date,value
1945-02-06,4.20
1952-03-11,42
```

The standard parser `parseCsv` returns a simple array with casted values:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

print_r(
    $web->parseCsv('https://test-pages.phpscraper.de/test.csv')
);
/**
 * [
 *     ['date', 'value'],
 *     ['1945-02-06', 4.20],
 *     ['1952-03-11', 42],
 * ]
 */
```

`parseCsvWithHeader` parses the content and uses the first line as headers and returns an associative array (map):

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

print_r(
    $web->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv')
);

/**
 * [
 *      ['date' => '1945-02-06', 'value' => 4.20],
 *      ['date' => '1952-03-11', 'value' => 42],
 * ]
 */
```

::: tip Type Casting
Native types such as `int` and `float` are automatically cast to PHP-native types.
:::

## Providing CSV Parsing Parameters

You might want to define which *separate*, *enclosure*, and *escape* to use. You can do so by passing an options array along:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Direct access:
$csv = $web
    ->parseCsv('https://test-pages.phpscraper.de/test-custom.csv', '|', '"');

// Alternative syntax using `go` first:
$csv = $web
    ->go('https://test-pages.phpscraper.de/test.csv')
    ->parseCsv(null, '|', '"');
```
