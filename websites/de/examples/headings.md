---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Kratzen von Überschriften

Überschriften können nützlich sein, um sich einen Überblick über den Inhalt einer Website zu verschaffen. Das folgende Beispiel zeigt, wie man scrapen kann:

 - Eine einzelne Überschrift
 - Alle Überschriften einer bestimmten Ebene (z.B. `<h3>`)
 - Alle Überschriften auf einer Seite


## Einzelne Überschrift kratzen

Das Einscannen einer einzelnen Überschrift ist einfach und kann anhand dieses Beispiels durchgeführt werden:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Sie enthält:
 *
 * <title>Wir testen hier!</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Drucken der H1-Überschrift
echo $web->h1[0];          // "Wir testen hier!"
```

::: tip
Der [Website-Titel](/examples/scrape-website-title) und die Überschrift 1 (`<h1>`) können unterschiedlich sein. Stellen Sie sicher, dass Sie die richtige abrufen.
:::


## Rubriken nach Ebene

Es kann Fälle geben, in denen Sie alle Überschriften einer bestimmten Ebene abrufen möchten. Das folgende Beispiel zeigt Ihnen, wie das geht:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Sie enthält:
 *
 * <h3>Beispiel 1</h3>
 * <p>Dies wäre ein Beispiel.</p>
 *
 * <h3>Beispiel 2</h3>
 * <p>Dies wäre das zweite Beispiel.</p>
 *
 * <h3>Beispiel 3</h3>
 * <p>Dies wäre ein weiteres Beispiel.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * Holen Sie sich die h3-Überschriften:
 *
 * [
 *    'Beispiel 1',
 *    'Beispiel 2',
 *    'Beispiel 3'
 * ]
 */
$secondaryHeadings = $web->h3;
```

Wenn keine Überschriften gefunden werden, bleibt das Feld leer.


## Alle Überschriften auf einer Seite

Um auf alle Rubriken einer Seite zuzugreifen, können Sie die verschiedenen Ebenen von 1 bis 6 anwählen. Alternativ können Sie auch alle auf einmal aufrufen:


```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zu der Testseite. Diese Seite enthält:
 *
 * <h1>Wir testen hier!</h1>
 * <p>Diese Seite enthält eine Beispielstruktur, die geparst werden soll. Sie enthält eine Reihe von Überschriften und verschachtelten Absätzen als Beispiel für das Scrapen.</p>
 *
 * <h2>Beispiele</h2>
 * <p>Es gibt zahlreiche Beispiele auf der Website. Schauen Sie sich diese an, um mehr darüber zu erfahren, wie Scraping funktioniert.</p>
 *
 * <h3>Beispiel 1</h3>
 * <p>Dies wäre ein Beispiel.</p>
 *
 * <h3>Beispiel 2</h3>
 * <p>Hier wäre das zweite Beispiel.</p>
 *
 * <h3>Beispiel 3</h3>
 * <p>Hier wäre ein weiteres Beispiel.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');


$headings = $web->headings;
/**
 * $headings enthält jetzt:
 *
 * [
 *     [
 *          'Wir testen hier!'
 *     ],
 *     [
 *          'Beispiele'
 *     ],
 *     [
 *          'Beispiel 1',
 *          'Beispiel 2',
 *          'Beispiel 3',
 *     ],
 *     [],
 *     [],
 *     []
 * ]
 */
```

Wie Sie sehen können, enthält dies keine Informationen über die Struktur der Überschriften. Es geht nur darum zu wissen, welche Überschriften vorhanden sind. Wenn Sie eine [Gliederung](/examples/outline) haben möchten, müssen Sie die entsprechenden Methoden verwenden.
