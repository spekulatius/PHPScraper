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

If you are in need for more details you can access these in a similar way as on the images. Below an example to access the detailed data of the first link on the page:

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

If you are requiring more data, you will either need to extend the library or submit an issue for consideration.
