---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Listas de raspado

El raspado de listas sigue un enfoque similar al de otros raspados con PHPScraper:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegar a la página de prueba. Esta página contiene:
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
 * Sólo listas desordenadas (<ul>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Lista de childNodes
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
 * Sólo listas ordenadas (<ol>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Lista de childNodes
 *     "children_plain" =>
 *     [
 *         "Ordered list item 1"
 *         "Ordered list item 2"
 *         "Ordered list item with HTML"
 *     ]
 * ]
 */
var_dump($web->orderedLists);

// Ambas listas combinadas (como la anterior)
var_dump($web->lists);
```

::: warning Listas anidadas
Por el momento, esto no maneja bien las listas anidadas. Las listas anidadas se incluyen en el resultado como `hijos` para permitir su procesamiento posterior.
:::
