---
image: https://api.imageee.com/bold?text=PHP:%20Navigate%20while%20Scraping&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Navigation

Bien que PHPScraper soit principalement destiné à analyser les sites Web et à collecter des informations, vous pouvez également l'utiliser pour naviguer sur les sites Web. Vous trouverez ci-dessous des exemples de façons de *surfer* sur un site Web.


## Navigation à l'aide d'URLs

Vous pouvez naviguer vers n'importe quelle URL. Ces URLs proviennent généralement du [liens analysés](/fr/examples/scrape-links.html).

```php
$web = new \spekulatius\phpscraper;

// Nous commençons sur la page de test #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Imprimez le titre pour voir si nous sommes bien à la bonne page...
echo $web->h1[0];   // 'Page #1'


// Nous naviguons vers la page de test n°2 en utilisant l'URL absolue.
$web->clickLink('https://test-pages.phpscraper.de/navigation/2.html');

// Imprimez le titre pour voir si nous sommes bien à la bonne page...
echo $web->h1[0];   // 'Page #2'
```


## Navigation à l'aide de textes d'ancrage

Sur un site Web, vous pouvez *cliquer* sur des liens en utilisant leurs textes d'ancrage:

```php
$web = new \spekulatius\phpscraper;

// Nous commençons sur la page de test #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

/**
 * Cette page contient:
 *
 * <a href="2.html">2 relative</a>
 */

// Imprimez le titre pour voir si nous sommes bien à la bonne page...
echo $web->h1[0];   // 'Page #1'


// Nous naviguons vers la page de test n°2 en utilisant le texte qu'il y a sur la page.
$web->clickLink('2 relative');

// Imprimez le titre pour voir si nous sommes bien à la bonne page...
echo $web->h1[0];   // 'Page #2'
```

Cette fonctionnalité de base devrait vous permettre de naviguer sur les sites web.
