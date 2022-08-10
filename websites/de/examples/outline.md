---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Gliederung Extractieren

Auch wenn Sie nur auf die [`Überschriften`](/examples/headings) zugreifen möchten, um z. B. die Anzahl oder Länge der Überschriften zu verarbeiten, reicht dies nicht immer aus. In einigen Fällen müssen Sie vielleicht die tatsächliche Struktur des Inhalts ermitteln. Für diese Anwendungsfälle sollten Sie eine der folgenden Methoden in Betracht ziehen:

 - `outline` funktioniert ähnlich wie die zuvor erwähnte Methode `headings`. Sie gibt ebenfalls alle Überschriften zurück, behält aber die Struktur des Originaldokuments bei und liefert nur die Überschriftenebenen (z.B. `h1`) mit der Ausgabe.

 - Die Methode `outlineWithParagraphs` funktioniert ähnlich wie `outline`, mit dem Unterschied, dass dieser Aufruf auch die Absätze enthält.

 - `cleanOutlineWithParagraphs` funktioniert ähnlich wie `outlineWithParagraphs`, mit dem Unterschied, dass alle leeren HTML-Tags entfernt werden.

Die folgenden Beispiele sollen helfen, die Funktionalität besser zu verstehen. Es sind spezielle Methoden für die [Schlüsselwort-Extraktion](/examples/extract-keywords) verfügbar.


## Extrahieren der Gliederung

Die Gliederung des Inhalts ermöglicht es Ihnen, einen Index des Dokuments zu erstellen. Im folgenden Beispiel wird eine Markdown-Version der Überschriften des angeforderten Dokuments erstellt:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zu der Testseite. Diese Seite enthält:
 *
 * <h1>Wir testen hier!</h1>
 * [...]
 *
 * <h2>Beispiele</h2>
 * [...]
 *
 * <h3>Beispiel 1</h3>
 * [...]
 *
 * <h3>Beispiel 2</h3>
 * [...]
 *
 * <h3>Beispiel 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$outline = $web->outline;
/**
 * $outline enthält jetzt:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "Wir testen hier!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Beispiele"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 3"
 *    ]
 * ]
 */
```


## Gliederung mit Absätzen extrahieren

Die folgende Methode funktioniert ähnlich wie `outline`, aber sie schließt auch alle Absätze als Teil des zurückgegebenen Arrays ein:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Diese Seite enthält:
 *
 * <h1>Wir testen hier!</h1>
 * <p>Diese Seite enthält eine Beispielstruktur, die geparst werden soll. Sie enthält eine Reihe von Überschriften und verschachtelten Absätzen als Beispiel für das Scrapen.</p>
 *
 * <h2>Beispiele</h2>
 * <p>Es gibt zahlreiche Beispiele auf der Website. Schauen Sie sich diese an, um mehr darüber zu erfahren, wie Scraping funktioniert.</p>
 *
 * <h3>Beispiel 1</h3>
 * <p>Hier wäre ein Beispiel.</p>
 *
 * <h3>Beispiel 2</h3>
 * <p>Hier wäre das zweite Beispiel.</p>
 *
 * <h3>Beispiel 3</h3>
 * <p>Hier wäre ein weiteres Beispiel.</p>
 *
 * <!-- ein leerer Absatz, um zu prüfen, ob er korrekt herausgefiltert wird -->
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
 *      "content" =>  "Wir testen hier!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Diese Seite enthält eine Beispielstruktur, die geparst werden soll. Sie enthält eine Reihe von Überschriften und verschachtelten Absätzen als Beispiel für das Scrapen."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Beispiele"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Auf der Website gibt es zahlreiche Beispiele. Schauen Sie sich diese an, um mehr darüber zu erfahren, wie Scraping funktioniert."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre ein Beispiel."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre das zweite Beispiel."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre ein weiteres Beispiel."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```


## Extrahieren der bereinigten Gliederung mit Absätzen

Die folgende Methode funktioniert ähnlich wie `outlineWithParagraphs`, aber sie enthält keine leeren Überschriften oder Absätze als Teil des zurückgegebenen Arrays:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Diese Seite enthält:
 *
 * <h1>Wir testen hier!</h1>
 * <p>Diese Seite enthält eine Beispielstruktur, die geparst werden soll. Sie enthält eine Reihe von Überschriften und verschachtelten Absätzen als Beispiel für das Scrapen.</p>
 *
 * <h2>Beispiele</h2>
 * <p>Es gibt zahlreiche Beispiele auf der Website. Schauen Sie sich diese an, um mehr darüber zu erfahren, wie Scraping funktioniert.</p>
 *
 * <h3>Beispiel 1</h3>
 * <p>Hier wäre ein Beispiel.</p>
 *
 * <h3>Beispiel 2</h3>
 * <p>Hier wäre das zweite Beispiel.</p>
 *
 * <h3>Beispiel 3</h3>
 * <p>Hier wäre ein weiteres Beispiel.</p>
 *
 * <!-- ein leerer Absatz, um zu prüfen, ob er korrekt herausgefiltert wird -->
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
 *      "content" =>  "Wir testen hier!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Diese Seite enthält eine Beispielstruktur, die geparst werden soll. Sie enthält eine Reihe von Überschriften und verschachtelten Absätzen als Beispiel für das Scrapen."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Beispiele"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Auf der Website gibt es zahlreiche Beispiele. Schauen Sie sich diese an, um mehr darüber zu erfahren, wie Scraping funktioniert."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre ein Beispiel."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre das zweite Beispiel."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Beispiel 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Dies wäre ein weiteres Beispiel."
 *    ]
 * ]
 */
```
