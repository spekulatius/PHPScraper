---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Links

The scraping of links works very similar to [image scraping](/examples/scrape-images). You can retrieve a list of URL without any additional information as well as a detailed list containing `rel`, `target` as well as other attributes.


## Simple Link List

The following example parses a web-page for links and returns an array of absolute URLs:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains 6 links to placekitten.com with different attributes:
 *
 * <h2>Different ways to wrap the attributes</h2>
 * <p><a href="https://placekitten.com/408/287" target=_blank>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="_blank">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='_blank'>external kitten</a></p>
 *
 * <h2>Named frame/window/tab</h2>
 * <p><a href="https://placekitten.com/408/287" target=kitten>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="kitten">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='kitten'>external kitten</a></p>
 */
$web->go('https://test-pages.phpscraper.de/links/target.html');

// Print the number of links.
echo "This page contains " . count($web->links) . " links.\n\n";

// Loop through the links
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Combined this will print out:
 *
 * This page contains 6 links.
 *
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 */
```

If the page shouldn't contain any links, an empty array is returned.


## Links with Details

If you are in need of more details you can access these in a similar way as on the images. Below is an example to access the detailed data of the first link on the page:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. This page contains a number of links with different rel attributes. To save space only the first one:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Get the first link on the page.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink contains now:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'text' => 'external kitten',
 *     'title' => null,
 *     'target' => null,
 *     'rel' => 'nofollow',
 *     'isNofollow' => true,
 *     'isUGC' => false,
 *     'isNoopener' => false,
 *     'isNoreferrer' => false,
 * ]
 */
```

If you require more data, you will either need to extend the library or submit an issue for consideration.


## Internal Links and External Links

PHPScraper allows to return only internal or external links. The internal links include links both the same root-domain as well as any sub-domain. If you are in need to get only the links within the exact sub-domain use [`subdomainLinks`](#sub-domain-links) instead. The following demonstrates both:

```php
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/links/base-href.html');

// Get the list of internal links (in the example an image is linked)
var_dump($web->internalLinks);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg'
 * ]
 */

// Get the list of external links
var_dump($web->externalLinks);
/**
 * [
 *     'https://placekitten.com/408/287'
 * ]
 */
```

## Sub-domain Links

If you need you retrieve only links on the exact sub-domain you can use the `subdomainLinks`-method:

```php
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/links/sub-domain-links.html');

var_dump($web->subdomainLinks);
/**
 * [
 *    'https://test-pages.phpscraper.de/',
 * ]
 */
```

::: warning
This might case issues when a site mixes links with *and* without 'www', as www is considered a sub-domain.
:::
