---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping von Bildern

Sie fragen sich vielleicht, wie man mit PHPScraper Fotos, Bilder und andere Grafiken von einer Website scrapen kann. Wie bei anderen Funktionen auch, folgt das Scraping von Bildern &amp; Fotos von einer Website einem ähnlichen Ansatz. Alle Grafiken wie Bilder, Fotos und Infografiken können zusammen mit Details wie Tag-Attributen oder nur als URL-Liste ausgelesen und analysiert werden.


## Scraping von Bild-URLs

Das folgende Beispiel durchsucht eine Webseite nach Bildern und gibt absolute Bild-URLs als Array zurück.

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese Seite enthält zwei Bilder:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 *
 * Anmerkung:
 * Doppelt, weil es zweimal das gleiche Bild ist:
 * Einmal mit einem relativen Pfad und einmal mit einem absoluten Pfad.
 * Die relativen Pfade werden standardmäßig in absolute Pfade aufgelöst.
 */
var_dump($web->images);
```

::: tip Tipp
Wenn keine Bilder gefunden werden, bleibt das Feld leer.
:::


## Scraping von Bildern mit Details

Wenn Sie mehr Details benötigen, können Sie mit den folgenden Anfragen auf die Attribute des Bild-Tags zugreifen:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

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
var_dump($web->imagesWithDetails);
```

::: tip SEO
Der `alt`-Text (mit den [Schlüsselwörtern des Inhalts](/de/examples/extract-keywords.html)) wird von Suchmaschinen für bildbasierte Suchen verwendet. Achten Sie darauf, ihn immer zu definieren.
:::


## Scraping-Attribute: Alt, Breite und Höhe

Die Attribute für "Alt", "Breite" und "Höhe" sind im ausführlichen Datensatz enthalten.

Wenn Sie mehr Daten benötigen, müssen Sie entweder die Bibliothek erweitern oder ein Problem zur Prüfung einreichen.
