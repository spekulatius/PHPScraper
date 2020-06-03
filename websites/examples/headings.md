---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Headings

Heading can be useful to get an idea of the content on a website. The following example shows how to scrape:

 - A single Heading
 - All headings of a particular level (e.g. `<h3>`)
 - All headings on a page


## Scrape Single Heading

Scraping a single heading is easy and be done following this example:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <title>We are testing here!</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Print the H1 heading
echo $web->h1[0];          // "We are testing here!"
```

::: tip
The [website title](/examples/scrape-website-title) and heading 1 (`<h1>`) can be different. Make sure you retrieve the correct one.
:::


## Headings by Level

There might be cases, in which you would like to retrieve all headings of a particular level. The example below shows you how to do so:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * Get the h3 headings:
 *
 * [
 *    'Example 1',
 *    'Example 2',
 *    'Example 3'
 * ]
 */
$secondaryHeadings = $web->h3;
```

If no headings are found, the array is left empty.


## All Headings on a Page

To access all headings on a page, you can do so by accessing the different levels from 1 to 6. Or, alternatively, you can access all at once:


```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. This page contains:
 *
 * <h1>We are testing here!</h1>
 * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
 *
 * <h2>Examples</h2>
 * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');


$headings = $web->headings;
/**
 * $headings contains now:
 *
 * [
 *     [
 *         'We are testing here!'
 *     ],
 *     [
 *         'Examples'
 *     ],
 *     [
 *         'Example 1',
 *         'Example 2',
 *         'Example 3',
 *     ],
 *     [],
 *     [],
 *     []
 * ]
 */
```

As you can see, this doesn't contain any information about the structure the headings are in. It's purely to know which headings exist. If you like to have an [outline](/examples/outline) you will need use the related methods.
