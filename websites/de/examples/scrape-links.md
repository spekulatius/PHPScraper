---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Links

Das Scraping von Links funktioniert sehr ähnlich wie [image scraping](/de/examples/scrape-images). Sie können sowohl eine Liste von URLs ohne zusätzliche Informationen als auch eine detaillierte Liste mit `rel`, `target` und anderen Attributen abrufen.


## Einfache Link-Liste

Das folgende Beispiel analysiert eine Webseite nach Links und gibt ein Array mit absoluten URLs zurück:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Sie enthält 6 Links zu placekitten.com mit unterschiedlichen Attributen:
 *
 * <h2>Verschiedene Möglichkeiten, die Attribute zu verpacken</h2>
 * <p><a href="https://placekitten.com/408/287" target=_blank>externes Kätzchen</a></p>
 * <p><a href="https://placekitten.com/444/333" target="_blank">externes Kätzchen</a></p>
 * <p><a href="https://placekitten.com/444/321" target='_blank'>externes Kätzchen</a></p>
 *
 * <h2>Benannt frame/window/tab</h2>
 * <p><a href="https://placekitten.com/408/287" target=kitten>externes Kätzchen</a></p>
 * <p><a href="https://placekitten.com/444/333" target="kitten">externes Kätzchen</a></p>
 * <p><a href="https://placekitten.com/444/321" target='kitten'>externes Kätzchen</a></p>
 */
$web->go('https://test-pages.phpscraper.de/links/target.html');

// Geben Sie die Anzahl der Links aus.
echo "This page contains " . count($web->links) . " links.\n\n";

// Schleife durch die Links
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Kombiniert wird dies ausgedruckt:
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

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zur Testseite. Diese Seite enthält eine Reihe von Links mit unterschiedlichen rel-Attributen. Um Platz zu sparen, wird nur der erste Link angezeigt:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">externes Kätzchen</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Ermittelt den ersten Link auf der Seite.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink enthält jetzt:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'text' => 'externes Kätzchen',
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

PHPScraper erlaubt es, nur interne oder externe Links zurückzugeben. Die internen Links beinhalten sowohl Links der gleichen Root-Domain als auch jeder Sub-Domain. Wenn Sie nur die Links innerhalb der genauen Subdomain benötigen, verwenden Sie stattdessen [`subdomainLinks`](#sub-domain-links). Das Folgende demonstriert beides:

```php
$web = new \spekulatius\phpscraper();

// Navigieren Sie zur Testseite.
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

## Sub-Domain Links

Wenn Sie nur Links auf die exakte Subdomain abrufen wollen, können Sie die `subdomainLinks`-Methode verwenden:

```php
$web = new \spekulatius\phpscraper();

// Navigieren Sie zur Testseite.
$web->go('https://test-pages.phpscraper.de/links/sub-domain-links.html');

var_dump($web->subdomainLinks);
/**
 * [
 *    'https://test-pages.phpscraper.de/',
 * ]
 */
```

::: warning
Dies kann zu Problemen führen, wenn eine Website Links mit *und* ohne "www" mischt, da www als Subdomain betrachtet wird.
:::
