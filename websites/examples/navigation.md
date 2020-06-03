---
image: https://api.imageee.com/bold?text=PHP:%20Navigate%20while%20Scraping&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Navigation

While PHPScraper is mostly intended to parse websites and collect information, you can also use it to navigate websites. Below are examples of ways to *surf* around a website.


## Navigation using URLs

You can navigate to any URL. These URLs usually come from the [parsed links](/examples/scrape-links).

```PHP
$web = new \spekulatius\phpscraper();

// We start on test page #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #1'


// We navigate to the test page #2 using the absolute URL.
$web->clickLink('https://test-pages.phpscraper.de/navigation/2.html');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #2'
```


## Navigation using Anchor Texts

On a website you can *click* on links using their anchor texts:

```PHP
$web = new \spekulatius\phpscraper();

// We start on test page #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

/**
 * This page contains:
 *
 * <a href="2.html">2 relative</a>
 */

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #1'


// We navigate to the test page #2 using the text it has on the page.
$web->clickLink('2 relative');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #2'
```

This basic functionality should allow you to navigate websites.
