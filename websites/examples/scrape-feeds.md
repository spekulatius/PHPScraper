---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Feeds%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Feeds

PHPScraper can identify and process feeds for you. Currently the following feeds are supported:

- RSS Feeds
- XML-Sitemaps
- Static Site Indexes


## RSS Feeds

You can identify any RSS feeds defined in the markup of the current page using `rssUrls`:

```php
$web = new \spekulatius\phpscraper;

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
$web->go('https://test-pages.phpscraper.de/meta/feeds.html');

// Print the URLs
echo $web->rssUrls;
/**
 * [
 *     'https://test-pages.phpscraper.de/absolute.xml',
 *     'https://test-pages.phpscraper.de/relative.xml'
 * ]
 */
```

## Parse RSS feeds

You can parse RSS feeds using `rss` in various ways:



