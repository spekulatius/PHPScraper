---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Feeds&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Feeds

PHPScraper can identify and process feeds (RSS feeds, sitemaps, etc.) for you. The following feed-specific features are implemented:

[[toc]]


## Identify RSS Feed URLs

Websites can define RSS feeds in the head section of their markup. PHPScraper allows to identify any RSS feeds noted on the current page using `rssUrls`:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

/**
 * Navigate to the test page. It contains:
 *
 * <link
 *   ref="alternative"
 *   type="application/rss+xml"
 *   href="https://test-pages.phpscraper.de/absolute.xml"
 * />
 * <link
 *   ref="alternative"
 *   type="application/rss+xml"
 *   href="/relative.xml"
 * />
 */

print_r(
    $web
        ->go('https://test-pages.phpscraper.de/meta/feeds.html')
        ->rssUrls
);

/**
 * [
 *     'https://test-pages.phpscraper.de/absolute.xml',
 *     'https://test-pages.phpscraper.de/relative.xml'
 * ]
 */
```


## Parse RSS feeds

The `rss()`-method can be used to parse RSS feeds. If called without any parameter `rssUrls` will be used:

```php
// Init and go to any page of the domain. This sets the base URL.
$web = new \Spekulatius\PHPScraper\PHPScraper;
$web->go('https://test-pages.phpscraper.de/meta/feeds.html');

// Same as `$web->rss(...$web->rssUrls)`
$rss = $web->rss();
```

You can also parse RSS feeds by passing one or more URLs in:

```php
// Single URL.
$rss = $web->rss($web->rssUrls[0]);

// Multiple URLs
$rss = $web->rss(
    'https://example.com/feed_1.xml',
    'https://example.com/feed_2.xml'
);
```

This result contains an array structure with selected properties. The array structure contains instances of `DataTransferObjects\FeedEntry` with properties for `link` and `title`.

::: tip Complete Details
If you need all details, please fallback on `$web->rssRaw(...)`. It can be called like `$web->rss(...)` and returns an array structure.
:::


## Parse XML Sitemaps

You can parse XML sitemaps using `sitemap()`:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

/**
 * Get the sitemap for the current website (if it exists).
 * This assumes the default URL `/sitemap.xml` is used.
 *
 * @throws \Exception (e.g. network).
 */
$sitemap = $web
    ->go('https://example.com')
    ->sitemap();

// You can pass in the desired URL:
$sitemap = $web->sitemap('https://example.com/custom_sitemap.xml');
```

This result contains only selected properties. It returns an array of `DataTransferObjects\FeedEntry` with the `link` property.

::: tip Complete Details
If you need all details, please fallback on `$web->sitemapRaw(...)`. It can be called like `$web->sitemap()` and returns an array structure.
:::


## Parse Static Search Indexes

You can parse static search indexes using `searchIndex()`:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

// Get the search index for the current website (if it exists).
// This assumes the default URL `/index.json` is used.
$searchIndex = $web
    ->go('https://example.com')
    ->searchIndex();

// You can pass in the desired URL:
$searchIndex = $web->searchIndex('https://example.com/custom_index.json');
```

**This result contains only selected properties.** It returns an array of `DataTransferObjects\FeedEntry` with properties `link`, `title`, and `description`.

::: tip Complete Details
If you need all details, please fallback on `$web->searchIndexRaw(...)`. It can be called like `$web->searchIndex()` and returns an array structure.
:::