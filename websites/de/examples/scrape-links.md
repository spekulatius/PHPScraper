---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Links

Das Scraping von Links funktioniert sehr ähnlich wie [image scraping](/de/examples/scrape-images.html). Sie können sowohl eine Liste von URLs ohne zusätzliche Informationen als auch eine detaillierte Liste mit `rel`, `target` und anderen Attributen abrufen.


## Einfache Link-Liste

Das folgende Beispiel analysiert eine Webseite nach Links und gibt ein Array mit absoluten URLs zurück:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese enthält 6 Links zu placekitten.com mit unterschiedlichen Attributen:
 *
 * <h2>Different ways to wrap the attributes</h2>
 * <p><a href="https://placekitten.com/408/287" target=_blank>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="_blank">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='_blank'>external kitten</a></p>
 *
 * <h2>Named frame/window/tab</h2>
 * <p><a href="https://placekitten.com/408/287" target=kitten>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="kitten">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='kitten'>external kitten</a></p>
 */
$web->go('https://test-pages.phpscraper.de/links/target.html');

// Geben Sie die Anzahl der Links aus.
echo "Diese Seite enthält " . count($web->links) . " Links.\n\n";

// Schleife durch die Links
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Kombiniert wird dies ausgegeben als:
 *
 * Diese Seite enthält 6 Links.
 *
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 */
```

Wenn die Seite keine Links enthalten soll, wird ein leeres Array zurückgegeben.


## Links mit Details

Wenn Sie weitere Details benötigen, können Sie diese auf ähnliche Weise wie bei den Bildern abrufen. Nachstehend finden Sie ein Beispiel für den Zugriff auf die detaillierten Daten des ersten Links auf der Seite:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese Seite enthält eine Reihe von Links mit unterschiedlichen rel-Attributen. Um Platz zu sparen, wird nur der erste Link angezeigt:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Ermittelt den ersten Link auf der Seite.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink enthält jetzt:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'protocol' => 'https',
 *     'text' => 'external kitten',
 *     'title' => null,
 *     'target' => null,
 *     'rel' => 'nofollow',
 *     'isNofollow' => true,
 *     'isUGC' => false,
 *     'isNoopener' => false,
 *     'isNoreferrer' => false,
 * ]
 */
```

Wenn Sie mehr Daten benötigen, müssen Sie entweder die Bibliothek erweitern oder eine Ausgabe zur Prüfung einreichen.


## Interne Links und externe Links

PHPScraper erlaubt es alle, interne oder externe Links zurückzugeben. Das folgende Beispiel demonstriert `internalLinks` sowie `externalLinks`:

```php
$web = new \spekulatius\phpscraper;

// Navigation zur Testseite.
$web->go('https://test-pages.phpscraper.de/links/base-href.html');

// Abrufen der Liste der internen Links (im Beispiel ist ein Bild verlinkt)
var_dump($web->internalLinks);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg'
 * ]
 */

// Abrufen der Liste der externen Links
var_dump($web->externalLinks);
/**
 * [
 *     'https://placekitten.com/408/287'
 * ]
 */
```
