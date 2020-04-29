# [PHP Scraper](https://phpscraper.de)

An oppinated & limited way to access the web using PHP. This is an extension to provide an alternative interface to [Guotte](https://github.com/FriendsOfPHP/Goutte).

## Examples

Fetching the title of a web page:

```PHP
$web = new \spekulatius\phpscraper();

$web->go('https://google.com');

// Return "Google"
echo $web->title;

// Returns also "Google"
echo $web->title();
```

Scraping the images with attributes on the img-tag:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page. This page contains twice the image "cat.jpg". Once with a relative path and once with an absolute path:
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

$web->imagesWithDetails
// returns:
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

See the [full documentation](https://phpscraper.de) for more information and examples.
