# Scraping Social Media Meta Tags

Scraping social media sharing tags from a website can be done using the following methods. The exact result set depends on the provided tags. All tags included, as along as these are in the prefixed namespace (e.g. `twitter:` for Twitter Cards).


## Open-Graph (OG) Data

Fetching open-graph data can be done:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/og/example.html');

/**
 * Page contains:
 *
 * <!-- open graph example -->
 * <meta property="og:site_name" content="Lorem ipsum" />
 * <meta property="og:type" content="website" />
 * <meta property="og:title" content="Lorem Ipsum" />
 * <meta property="og:description" content="Lorem ipsum dolor etc." />
 * <meta property="og:url" content="https://test-pages.phpscraper.de/lorem-ipsum.html" />
 * <meta property="og:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/og/example.html
 */

// Should print 'Lorem Ipsum'
echo $web->openGraph['og:title'];

// Should print 'Lorem ipsum dolor etc.'
echo $web->openGraph['og:description'];

// the whole set:
$data = $web->openGraph;

/**
 * $data now contains:
 *
 * [
 *     'og:site_name' => 'Lorem ipsum',
 *     'og:type' => 'website',
 *     'og:title' => 'Lorem Ipsum',
 *     'og:description' => 'Lorem ipsum dolor etc.',
 *     'og:url' => 'https://test-pages.phpscraper.de/lorem-ipsum.html',
 *     'og:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

If not data was found, the array will be returned empty.


## Twitter Card

Loading a Twitter Card follows a simliar approach:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
$web->go('https://test-pages.phpscraper.de/twittercard/example.html');

/**
 * The page contains the following Twitter card:
 *
 * <!-- Twitter card -->
 * <meta name="twitter:card" content="summary_large_image" />
 * <meta name="twitter:title" content="Lorem Ipsum" />
 * <meta name="twitter:description" content="Lorem ipsum dolor etc." />
 * <meta name="twitter:url" content="https://test-pages.phpscraper.de/lorem-ipsum.html" />
 * <meta name="twitter:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/twittercard/example.html
 */

// Should print out 'summary_large_image'
echo $web->twitterCard['twitter:card']);

// Should print out 'Lorem Ipsum'
echo $web->twitterCard['twitter:title']);

// The whole set.
$data = $web->twitterCard;

/**
 * $data contains now:
 *
 * [
 *     'twitter:card' => 'summary_large_image',
 *     'twitter:title' => 'Lorem Ipsum',
 *     'twitter:description' => 'Lorem ipsum dolor etc.',
 *     'twitter:url' => 'https://test-pages.phpscraper.de/lorem-ipsum.html',
 *     'twitter:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

In similar fashion to Open Graph, the array will be empty if not Twitter Card tags have been found.
