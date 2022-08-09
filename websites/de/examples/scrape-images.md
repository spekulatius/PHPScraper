---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping von Bildern

Das Scraping der Bilder &amp; Fotos von einer Website folgt einem ähnlichen Ansatz wie die anderen Beispiele. Alle Grafiken wie Bilder, Fotos und Infografiken können mit Details wie Tag-Attributen oder nur als URL-Liste geparst werden.


## Scraping von Bild-URLs

Das folgende Beispiel durchsucht eine Webseite nach Bildern und gibt absolute Bild-URLs als Array zurück.

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Diese Seite enthält zwei Bilder:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Prüfen, ob Bilder gefunden wurden
$images = $web->images;
if (count($images) > 0) {

    var_dump($images);
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
}
```

::: tip Tipp
Wenn keine Bilder gefunden werden, bleibt das Feld leer.
:::


## Scraping von Bildern mit Details

Wenn Sie mehr Details benötigen, können Sie mit den folgenden Anfragen auf die Attribute des Bild-Tags zugreifen:

```PHP
$web = new \spekulatius\phpscraper();
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

::: tip SEO
Der `alt`-Text (mit den [Schlüsselwörtern des Inhalts](/examples/extract-keywords)) wird von Suchmaschinen für bildbasierte Suchen verwendet. Achten Sie darauf, ihn immer zu definieren.
:::


## Scraping-Attribute: Alt, Breite und Höhe

Die Attribute für "Alt", "Breite" und "Höhe" sind im ausführlichen Datensatz enthalten.

Wenn Sie mehr Daten benötigen, müssen Sie entweder die Bibliothek erweitern oder ein Problem zur Prüfung einreichen.
