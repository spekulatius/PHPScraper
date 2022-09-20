---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Gliederung Extrahieren

Auch wenn Sie nur auf die [`Überschriften`](/de/examples/headings.html) zugreifen möchten, um z.B. die Anzahl oder Länge der Überschriften zu verarbeiten, reicht dies nicht immer aus. In einigen Fällen müssen Sie vielleicht die tatsächliche Struktur des Inhalts ermitteln. Für diese Anwendungsfälle sollten Sie eine der folgenden Methoden in Betracht ziehen:

 - `outline` funktioniert ähnlich wie die zuvor erwähnte Methode `headings`. Sie gibt ebenfalls alle Überschriften zurück, behält aber die Struktur des Originaldokuments bei und liefert nur die Überschriftenebenen (z.B. `h1`) mit der Ausgabe.

 - Die Methode `outlineWithParagraphs` funktioniert ähnlich wie `outline`, mit dem Unterschied, dass dieser Aufruf auch die Absätze enthält.

 - `cleanOutlineWithParagraphs` funktioniert ähnlich wie `outlineWithParagraphs`, mit dem Unterschied, dass alle leeren HTML-Tags entfernt werden.

Die folgenden Beispiele sollen helfen, die Funktionalität besser zu verstehen. Es sind spezielle Methoden für die [Schlüsselwort-Extraktion](/de/examples/extract-keywords.html) verfügbar.


## Extrahieren der Gliederung

Die Gliederung des Inhalts ermöglicht es Ihnen, einen Index des Dokuments zu erstellen. Im folgenden Beispiel wird eine Markdown-Version der Überschriften des angeforderten Dokuments erstellt:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese Seite enthält:
 *
 * <h1>We are testing here!</h1>
 * [...]
 *
 * <h2>Examples</h2>
 * [...]
 *
 * <h3>Example 1</h3>
 * [...]
 *
 * <h3>Example 2</h3>
 * [...]
 *
 * <h3>Example 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

/**
 * $outline wird gesetzt auf:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ]
 * ]
 */
$outline = $web->outline;
```


## Gliederung mit Absätzen extrahieren

Die folgende Methode funktioniert ähnlich wie `outline`, aber sie schließt auch alle Absätze als Teil des zurückgegebenen Arrays ein:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->outlineWithParagraphs;
/**
 * $content now contains:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```


## Extrahieren der bereinigten Gliederung mit Absätzen

Die folgende Methode funktioniert ähnlich wie `outlineWithParagraphs`, aber diese enthält keine leeren Überschriften oder Absätze als Teil des zurückgegebenen Arrays:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->cleanOutlineWithParagraphs;
/**
 * $content enthält jetzt:
  *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ]
 * ]
 */
```
