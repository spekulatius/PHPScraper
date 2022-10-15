---
image: https://api.imageee.com/bold?text=PHP%20Scraper:%20Scraping%20und%20Crawling%20einfach%20gemacht&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

PHP Scraper: Scraping und Crawling einfach gemacht
==================================================

![PHP Scraper: Scraping und Crawling einfach gemacht](logo-light.png)

*von [Peter Thaleikis](https://peterthaleikis.com)*

PHPScraper ist eine Scraping-Bibliothek ohne Schnickschnack für PHP. Bei PHPScraper handelt sich dabei um einen Wrapper um einige großartige PHP-Bibliotheken, die den Zugriff auf das Web erleichtern.

Die Beispiele vermitteln die Idee besser. Einen Blick wert!


Die Idee 💡️
----------

Der Zugriff auf Websites und das Sammeln grundlegender Informationen aus dem Web ist oft zu komplex. Dieser Wrapper um [Goutte](https://github.com/FriendsOfPHP/Goutte) macht es einfacher. Er erspart Ihnen XPath und Co. und ermöglicht Ihnen den direkten Zugriff auf alles, was Sie brauchen. Web Scraping mit PHP *etwas anders*.


Unterstützer 💪️
-------------

Dieses Projekt wird gesponsert von:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Möchten Sie dieses Projekt unterstützen? [Schreib mir](https://peterthaleikis.com/contact).


Beispiele: Code sagt mehr als Tausend Worte.
--------------------------------------------

Hier sind einige Beispiele dafür, was die Web-Scraping-Bibliothek an dieser Stelle tun kann:

### Scrape Meta-Informationen:

```php
$web = new \spekulatius\phpscraper;

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

Nahezu alle Informationen können direkt als string oder array genutzt werden.


### Scrape Content, beispielsweise Bilder:

```php
$web = new \spekulatius\phpscraper;

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

Hier werden einige zusätzliche, *optionale* Informationen im Array als Details zurückgegeben. Alternativ ist für dieses Beispiel ist auch eine vereinfachte Liste nur mit den Bildern mit `$web->images` verfügbar:

```php
// Wie oben.

var_dump($web->images);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 *
 * // Hinweis: Doppelt, da die Seite das Bild mehrfach enthält.
 */
```

Mehr Beispielcode finden Sie in den Einzelbeispielen und in den Tests.


Installation
------------

Die Installation erfolgt üblicherweise mit [Composer](https://getcomposer.org).

### Installation mit Composer

```bash
composer require spekulatius/phpscraper
```

Nach Abschluss der Installation wird das Paket vom Composer-Autoloader geladen. Damit wird in den meisten PHP applikationen sichergstellt, dass die Klassen entsprechend geladen werden können. Mit dem Scrapen kann direkt begonnen werden. Sie können nun eines der aufgeführten Beispiele oder weiteren Beispiele aus den `tests/` verwenden.

### Verwendung in VanillaPHP-Projekten

Wenn Sie ein VanillaPHP-Projekt bauen, müssen Sie den Autoloader oben im Skript einbinden:

```php
require 'vendor/autoload.php';
```

Wenn Sie ein Framework wie Laravel, Symfony, Laminas, Phalcon, oder CakePHP verwenden, brauchen Sie diesen Schritt nicht. Der Autoloader übernimmt die Arbeit.


Konfiguration
-------------

Die weitere Konfiguration ist optional. Unterhalb finden Sie die gegenwärtig verfügbaren Optionen:

### Proxy

Falls Sie Proxies benötigen können Sie PHPScraper wie folgt konfigurieren:

```php
$web->setConfig(['proxy' => 'http://user:password@127.0.0.1:3128']);
```

::: tip
Falls Sie nach einem günstigen Proxy suchen ist [IProyal](https://iproyal.com?r=119987) einen Blick wert.
:::

### Timeout setzen

Das `timeout` kann mit `setConfig` gesetzt werden:

```php
$web->setConfig(['timeout' => 15]);
```

Der timeout kann mit `0` gedeaktiviert werden.

### Disabling SSL

Während es nicht empfohlen ist, kann es notwendig sein die SSL checks zu deaktivieren. Dies kann wie folgt erreicht werden:

```php
$web->setConfig(['disable_ssl' => true]);
```

`setConfig` kann mehrfach aufgerufen werden. Es speichert die Konfiguration und merged frühere Einstellungen. Dies sollte bedacht werden, wenn man etwas zurücksetzen will.


Ein Problem gefunden und gefixt? Super!
---------------------------------------

Bevor Sie loslegen, machen Sie sich mit den [Contribution Guidelines](/contributing.html) vertraut. Bei Fragen bitte eine kurze Nachricht oder Email.


Tests: Damit es wirklich funktioniert!
--------------------------------------

Der Code wird grob mit End-to-End-Tests abgedeckt. Dazu werden einfache Webseiten unter *https://test-pages.phpscraper.de/* gehostet, geladen und geparst mit [PHPUnit](https://phpunit.de/). Diese Tests sind auch als Beispiele geeignet - siehe `tests/`!

Trotzdem gibt es wahrscheinlich Randfälle, die nicht funktionieren und Probleme verursachen können. Wenn Sie einen finden, melden Sie bitte einen Fehler auf GitHub.
