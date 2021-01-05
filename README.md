![PHP Scraper](header.jpg)

# [PHP Scraper](https://github.com/spekulatius/phpscraper)

An opinionated & limited way to scrape the web using PHP. The main goal is to get stuff done instead of getting distracted with xPath selectors, preparing data structures, etc. Instead, you can just "go to a website" and get an array with all details relevant to your scraping project.

Under the hood, it uses [Goutte](https://github.com/FriendsOfPHP/Goutte) and a few other packages. See [composer.json](https://github.com/spekulatius/PHPScraper/blob/master/composer.json).


## Sponsors

This project is sponsored by:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Want to sponsor this project? [Contact me](https://peterthaleikis.com/contact).


## Examples

Here are a few impressions on the way the library works. More examples are on the [project website](https://phpscraper.de/examples/scrape-website-title.html).

### Get the Title of a Website

All scraping functionality can be accessed either as a function call or a property call. On the example of title scraping this would like like this:

```php
$web = new \spekulatius\phpscraper();

$web->go('https://google.com');

// Returns "Google"
echo $web->title;

// Also returns "Google"
echo $web->title();
```

### Scrape the Images from a Website

Scraping the images including the attributes of the `img`-tags:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page.
 *
 * This page contains twice the image "cat.jpg".
 * Once with a relative path and once with an absolute path.
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
