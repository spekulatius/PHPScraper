---
image: https://api.imageee.com/bold?text=PHP:%20Navigate%20while%20Scraping&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Navigation

Obwohl PHPScraper hauptsächlich dazu gedacht ist, Webseiten zu analysieren und Informationen zu sammeln, kannst du es auch benutzen, um auf Webseiten zu navigieren. Im Folgenden finden Sie Beispiele, wie Sie auf einer Website *surfen* können.


## Navigation über URLs

Sie können zu jeder URL navigieren. Diese URLs stammen normalerweise aus den [geparsten Links](/de/examples/scrape-links.html).

```php
$web = new \spekulatius\phpscraper;

// Wir beginnen mit der Testseite Nr. 1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Ausgaben des Titel, um zu sehen, ob wir tatsächlich auf der richtigen Seite sind...
echo $web->h1[0];   // 'Page #1'


// Wir navigieren zur Testseite #2 unter Verwendung der absoluten URL.
$web->clickLink('https://test-pages.phpscraper.de/navigation/2.html');

// Ausgaben des Titel, um zu sehen, ob wir tatsächlich auf der richtigen Seite sind...
echo $web->h1[0];   // 'Page #2'
```


## Navigation mit Ankertexten

Auf einer Website können Sie auf Links *klicken*, indem Sie deren Ankertexte verwenden:

```php
$web = new \spekulatius\phpscraper;

// Wir beginnen mit der Testseite Nr. 1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

/**
 * Diese Seite enthält:
 *
 * <a href="2.html">2 relative</a>
 */

// Ausgaben des Titel, um zu sehen, ob wir tatsächlich auf der richtigen Seite sind...
echo $web->h1[0];   // 'Page #1'


// Wir navigieren zur Testseite #2, indem wir den Text verwenden, der auf der Seite steht.
$web->clickLink('2 relative');

// Ausgaben des Titel, um zu sehen, ob wir tatsächlich auf der richtigen Seite sind...
echo $web->h1[0];   // 'Page #1'
```

Diese Grundfunktionalität sollte es Ihnen ermöglichen, auf Websites zu navigieren.
