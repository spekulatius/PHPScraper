---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Images

You might wonder how to scrape photos, images and other graphics from a website using PHPScraper. As with other functionality, scraping the images &amp; photos from a website follows a similar approach. All graphics such as images, photos, and infographics can be scraped and parsed along with details such as tag attributes or only as an URL list.


## Scrape Image URLs

The following example parses a web-page for images and returns absolute image URLs as an array.

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;

/**
 * Navigate to the test page. This page contains two images:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 *
 * @note
 * The URL is listed twice because it's included twice on the page:
 * Once with a relative path and once with an absolute path.
 * The relative paths are resolved to absolute paths by default.
 */
var_dump($web->images);
```

::: tip
If no images are found, the array remains empty. You can download images using `$web->fetchAsset(...)`.
:::


## Scrape Images with Details

If you are in need of more details the following requests allows you to access attributes of the image tag:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

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
var_dump($web->imagesWithDetails);
```

::: tip SEO
The `alt`-text (with the [keywords of the content](/examples/extract-keywords.html)) is used by search engines for image-based searches. Make sure to always define it.
:::


## Scrape Attributes: Alt, Width and Height

The attributes for `alt`, `width` and `height` are included in the detailed data set.

If you require more data, you will either need to extend the library or submit an issue for consideration.


## Fetching Assets

If you want to fetch assets, you can do so using `fetchAsset`:

```php
$web = new \Spekulatius\PHPScraper\PHPScraper;
$sharingImage = $web->fetchAsset($web->image);
```
