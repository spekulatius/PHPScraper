![PHP Scraper](header.jpg)

# [PHP Scraper](https://github.com/spekulatius/phpscraper)

An oppinated & limited way to access the web using PHP. This is an extension to provide an alternative interface to [Goutte](https://github.com/FriendsOfPHP/Goutte). The [examples](https://phpscraper.de/) tell the story much better. Have a look!


## Sponsors

This project is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Want to sponsor this project? [Contact me](https://peterthaleikis.com/contact).


## Examples

Here are a few impressions on the way the library works. More examples are on the project website.

Fetching the title of a web page:

```php
$web = new \spekulatius\phpscraper();

$web->go('https://google.com');

// Returns "Google"
echo $web->title;

// Returns also "Google"
echo $web->title();
```

Scraping the images with attributes on the img-tag:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page.
 *
 * This page contains twice the image "cat.jpg". Once with a relative path and once with an absolute path.
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
/**
 * Contains:
 *
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
