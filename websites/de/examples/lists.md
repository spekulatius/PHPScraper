---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Listen Scrapen

Das Scraping von Listen folgt einem ähnlichen Ansatz wie anderes Scraping mit PHPScraper:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigation zur Testseite. Diese Seite enthält:
 *
 * <h2>Example 1: Unordered List</h2>
 * <ul>
 *     <li>Unordered list item 1</li>
 *     <li>Unordered list item 2</li>
 *     <li>Unordered list item with <b>HTML</b></li>
 * </ul>
 *
 * <h2>Example 2: Ordered List</h2>
 * <ol>
 *     <li>Ordered list item 1</li>
 *     <li>Ordered list item 2</li>
 *     <li>Ordered list item with <i>HTML</i></li>
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
 *         "Unordered list item 1"
 *         "Unordered list item 2"
 *         "Unordered list item with HTML"
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
 *         "Ordered list item 1"
 *         "Ordered list item 2"
 *         "Ordered list item with HTML"
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
