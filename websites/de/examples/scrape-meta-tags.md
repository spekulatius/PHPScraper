---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Meta%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Meta Tags

Der Zugriff auf die Meta-Informationen erfolgt nach einem ähnlichen Muster wie bei den zuvor gezeigten [header-tags](/de/examples/scrape-header-tags.html). Nachfolgend finden Sie eine Reihe von Beispielen:


## Meta Autor, Beschreibung und Bild

Das folgende Beispiel zeigt die Extraktion von drei Attributen:

- der Meta-Autor,
- die Meta-Beschreibung und
- die Meta Image URL

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Abrufen der Informationen:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```


## Meta-Keywords

Der Meta-Tag keywords ist natürlich ein Array und wird zu Ihrer Bequemlichkeit aufgeteilt:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält:
 *
 * <meta name="keywords" content="one, two, three">
 */
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Auslesen der Schlüsselwörter als Array
var_dump($web->keywords);   // ['one', 'two', 'three']
```

Alternatively, you can access the original keyword string:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Ausgabe der Schlüsselwörter als String
echo $web->keywordString;   // "one, two, three"
```

::: tip Tipp
Dies bezieht sich nur auf die Schlüsselwörter im "keyword"-Meta-Tag. Sie können auch [die Schlüsselwörter des Inhalts](/de/examples/extract-keywords.html)) mit PHPScraper extrahieren.
:::


## Kombinierte Meta-Tags

Wenn Sie auf alle Meta-Eigenschaften zugreifen möchten, können Sie die `metaTags`-Methode verwenden. Sie gibt die oben genannten Methoden als Array zurück. Sie ist definiert als:

```php
/**
 * Liefert die gesammelten Metadaten als Array
 *
 * @return array
 */
public function metaTags()
{
    return [
        'author' => $this->author(),
        'image' => $this->image(),
        'keywords' => $this->keywords(),
        'description' => $this->description(),
    ];
}
```

Im obigen Beispiel würde es wie folgt verwendet werden:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

var_dump($web->metaTags);
/**
 * Enthält:
 *
 * [
 *     'Lorem ipsum',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     ['one', 'two', 'three'],
 *     'Lorem ipsum dolor etc.',
 * ]
 */
```


## Fehlende Meta-Tags

Wenn Sie auf eine andere Meta-Eigenschaft zugreifen müssen, bitte lesen Sie die [Contribution Guidelines](/contributing.html) bevor Sie einen Pull Request öffnen oder ein [Issue auf GitHub](https://github.com/spekulatius/phpscraper/issues) aufmachen.
