---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrapen von Überschriften

Überschriften können nützlich sein, um sich einen Überblick über den Inhalt einer Website zu verschaffen. Das folgende Beispiel zeigt, wie man scrapen kann:

 - Eine einzelne Überschrift
 - Alle Überschriften einer bestimmten Ebene (z.B. `<h3>`)
 - Alle Überschriften auf einer Seite


## Einzelne Überschrift Scrapen

Das Einscannen einer einzelnen Überschrift ist einfach und kann anhand dieses Beispiels durchgeführt werden:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <title>Outline Test</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Ausgeben der H1-Überschrift
echo $web->h1[0];          // "Outline Test"
```

::: tip
Der [Website-Titel](/de/examples/scrape-website-title.html) und die Überschrift 1 (`<h1>`) können unterschiedlich sein. Stellen Sie sicher, dass Sie die richtige abrufen.
:::


## Rubriken nach Ebene

Es kann Fälle geben, die Überschriften einer bestimmten Ebene abgerufen werden sollen. Das folgende Beispiel zeigt, wie dies möglich ist:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
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
 * Gibt die h3-Überschriften zurück:
 *
 * [
 *    'Example 1',
 *    'Example 2',
 *    'Example 3'
 * ]
 */
$web->h3;
```

Wenn keine Überschriften gefunden werden, bleibt das Feld leer.


## Alle Überschriften auf einer Seite

Um auf alle Rubriken einer Seite zuzugreifen, können Sie die verschiedenen Ebenen von 1 bis 6 anwählen. Alternativ können Sie auch alle auf einmal aufrufen:


```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese Seite enthält:
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

/**
 * $headings enthält jetzt:
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
$web->headings;
```

Wie Sie sehen können, enthält dies keine Informationen über die Struktur der Überschriften. Es geht nur darum zu wissen, welche Überschriften vorhanden sind. Wenn Sie eine [Gliederung](/de/examples/outline.html) haben möchten, müssen Sie die entsprechenden Methoden verwenden.
