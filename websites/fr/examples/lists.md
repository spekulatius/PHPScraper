---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Lists

Le scrapping de listes suit une approche similaire aux autres scrappings avec PHPScraper:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguer vers la page de test. Cette page contient:
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
 * Seulement les listes non ordonnées (<ul>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Liste des childNodes
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
 * Seulement les listes ordonnées (<ol>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Liste des childNodes
 *     "children_plain" =>
 *     [
 *         "Ordered list item 1"
 *         "Ordered list item 2"
 *         "Ordered list item with HTML"
 *     ]
 * ]
 */
var_dump($web->orderedLists);


// Les deux listes combinées (comme ci-dessus)
var_dump($web->lists);
```

::: warning Listes imbriquées
Pour l'instant, le système ne gère pas bien les listes imbriquées. Les listes imbriquées sont incluses dans le résultat en tant que "enfants" pour permettre un traitement ultérieur.
:::
