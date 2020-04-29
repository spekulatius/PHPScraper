# Scraping Images

Scraping the images from a website follows similar an similar approach as the other examples. Images can be parsed with details such as tag attributes or only as an URL list.


## Scarping Image URLs

The following example parses a web-page for images and returns absolute URLs as an array.

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page. This page contains two images (cat.jpg).
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * contains:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */

// Check if any images have been found
$images = $web->images;

if (count($images) > 0) {

    var_dump($images);
    /**
     * [
     *     'https://test-pages.phpscraper.de/assets/cat.jpg',
     *     'https://test-pages.phpscraper.de/assets/cat.jpg',
     * ]
     *
     * Note: Double because it's twice the same image.
     */

}
```

::: tip No Images
If no images are found, the array remains empty.
:::


## Scarping Images with Details

If you are in need for more details the following requests allows you to access attributes of the image tag:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page. This page contains two images (cat.jpg).
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * contains:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */

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

Double because it's twice the same image - once with a relative path and once with an absolute path. The relative paths are resolved to absolute paths by default.


## Scraping Attributes: Alt, Width and Height

The attributes for `alt`, `width` and `height` are included by in the detailed data set.

If you are requiring more data, you will either need to extend the library or submit an issue for consideration.
