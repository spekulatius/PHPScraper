---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Header%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Header Tags

Die Header-Tags enthalten oft nützliche Informationen über eine Webseite und darüber, wie sie sich in die Gesamtstruktur der Website einfügt, zu der sie gehört. Die folgenden Beispiele zeigen, wie man auf bestimmte Informationen aus dem `<head>` zugreift und Sammlungen um diese herum erstellt.


## Charset / Zeichensatz

Um auf den definierten Zeichensatz zuzugreifen, können Sie die folgende Methode verwenden:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta charset="utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Gibt den charset aus:
echo $web->charset;     // "utf-8"
```


## Viewport

In einigen Fällen, wie z.B. dem Viewport und den Meta-Keywords, stellt die Zeichenkette ein Array dar und wird als solches angegeben:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Gibt den Viewport als Array zurück. Es beinhaltet:
 *
 * [
 *     'width=device-width',
 *     'initial-scale=1',
 *     'shrink-to-fit=no',
 *     'maximum-scale=1',
 *     'user-scalable=no'
 * ],
 */
var_dump($web->viewport);
```

Wenn Sie auf die ursprüngliche Reihenfolge zugreifen müssen, können Sie diese mit `viewportString` abrufen:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Gibt den Viewport als String zurück:
 *
 * "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"
 */
echo $web->viewportString;
```


## Canonical URL

Auf die kanonische URL kann, sofern vorhanden, wie im folgenden Beispiel gezeigt, zugegriffen werden:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
 */
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Ausgabe der canonical URL
echo $web->canonical;       // "https://test-pages.phpscraper.de/navigation/2.html"
```

::: tip Tipp
Wenn kein kanonischer Link gesetzt ist, gibt die Methode `null` zurück.
:::


## Content-Type

Um auf den Inhaltstyp zuzugreifen, können Sie die folgenden Funktionen nutzen:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Ausgabe des contentType
echo $web->contentType;     // "text/html; charset=utf-8"
```


## CSFR Token

Die CSFR-Token-Methode geht davon aus, dass das Token in einem Meta-Tag mit dem Namen "csrf-token" gespeichert ist. Dies ist der Standard für Laravel. Sie können mit folgendem Code darauf zugreifen:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta name="csrf-token" content="token" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Gibt den csrfToken aus:
echo $web->csrfToken;     // "token"
```


## Kombinierte Kopfzeilen-Tags

Wenn Sie auf alle oben genannten Methoden zugreifen wollen, verwenden Sie die Methode `headers`. Sie ist definiert als:

```php
/**
 * @return array
 */
public function headers()
{
    return [
        'charset' => $this->charset(),
        'contentType' => $this->contentType(),
        'viewport' => $this->viewport(),
        'canonical' => $this->canonical(),
        'csrfToken' => $this->csrfToken(),
    ];
}
```

Weitere Informationen zum Zugriff auf die [Meta-Tags](/de/examples/scrape-meta-tags.html).
