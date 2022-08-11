---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Listen Scrapen

Das Scraping von Listen folgt einem ähnlichen Ansatz wie anderes Scraping mit PHPScraper:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigieren Sie zu der Testseite. Diese Seite enthält:
 *
 * <h2>Beispiel 1: Ungeordnete Liste</h2>
 * <ul>
 * <li>Ungeordnete Liste Punkt 1</li>
 * <li>Ungeordnete Liste Punkt 2</li>
 * <li>Ungeordneter Listeneintrag mit <b>HTML</b></li>
 * </ul>
 *
 * <h2>Beispiel 2: Geordnete Liste</h2>
 * <ol>
 * <li>Geordnete Liste Punkt 1</li>
 * <li>Geordnete Liste Punkt 2</li>
 * <li>Gereihte Liste mit <i>HTML</i></li>
 * </ol>
 */
$web->go('https://test-pages.phpscraper.de/content/lists.html');

/**
 * Nur unsortierte Listen (<ul>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Liste der ChildNodes
 *     "children_plain" =>
 *     [
 *         "Ungeordnetes Listenelement 1"
 *         "Ungeordnetes Listenelement 2"
 *         "Ungeordnetes Listenelement mit HTML"
 *     ]
 * ]
 */
var_dump($web->unorderedLists);


/**
 * Nur geordnete Listen (<ol>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Liste der ChildNodes
 *     "children_plain" =>
 *     [
 *         "Bestellte Listenposition 1"
 *         "Bestellte Listenposition 2"
 *         "Geordneter Listeneintrag mit HTML"
 *     ]
 * ]
 */
var_dump($web->orderedLists);


// Beide Listen zusammen (wie oben)
var_dump($web->lists);
```

::: warning Verschachtelte Listen
Im Moment werden verschachtelte Listen nicht gut verarbeitet. Verschachtelte Listen werden als `children` in das Ergebnis aufgenommen, um eine weitere Verarbeitung zu ermöglichen.
:::
