---
image: https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

Eine *etwas andere* Web-Scraping-Bibliothek für PHP
===========================================

*von [Peter Thaleikis](https://peterthaleikis.com)*

Web Scraping mit PHP kann man einfacher machen werden. Hier handelt es sich um eine experimentiEs handelt sich dabei um eine meinungsstarke Hülle um einige großartige PHP-Bibliotheken, die den Zugriff auf das Web erleichtern.

Die Beispiele erzählen die Geschichte viel besser. Einen Blick wert!


Die Idee 💡️
----------

Der Zugriff auf Websites und das Sammeln grundlegender Informationen aus dem Web ist oft zu komplex. Dieser Wrapper um [Goutte](https://github.com/FriendsOfPHP/Goutte) macht es einfacher. Er erspart Ihnen XPath und Co. und ermöglicht Ihnen den direkten Zugriff auf alles, was Sie brauchen. Web Scraping mit PHP *etwas anders*.


Unterstützer 💪️
-------------

Dieses Projekt wird gesponsert von:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Möchten Sie dieses Projekt unterstützen? [Kontaktieren Sie mich](https://peterthaleikis.com/contact).


Beispiele
--------

Hier sind einige Beispiele dafür, was die Web-Scraping-Bibliothek an dieser Stelle tun kann:

### Scrape Meta-Informationen:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Get the information:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```

Most other information can be accessed directly - either as string or an array.


### Scrape Content, such as Images:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. This page contains two images:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
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

Some information *optionally* is returned as an array with details. For this example, a simple list of images is available using `$web->images` too. This should make your web scraping easier.

More example code can be found in the sidebar or the tests.


Installation
------------

Die Installation erfolgt über Composer:

```bash
composer require spekulatius/phpscraper
```

Dadurch wird automatisch sichergestellt, dass das Paket geladen wird und Sie mit dem Scrapen beginnen können. Sie können nun eines der aufgeführten Beispiele verwenden.


Ein Problem gefunden und gefixt? Super!
---------------------------------------

Bevor Sie loslegen, machen Sie sich mit den [Contribution Guidelines](/contributing) vertraut. Bei Fragen bitte eine kurze Nachricht oder Email.

Tests
-----

Der Code wird grob mit End-to-End-Tests abgedeckt. Dazu werden einfache Webseiten unter *https://test-pages.phpscraper.de/* gehostet, geladen und geparst mit [PHPUnit](https://phpunit.de/). Diese Tests sind auch als Beispiele geeignet - siehe `tests/`!

Trotzdem gibt es wahrscheinlich Randfälle, die nicht funktionieren und Probleme verursachen können. Wenn Sie einen finden, melden Sie bitte einen Fehler auf GitHub.
