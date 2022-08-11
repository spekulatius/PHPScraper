---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Listas de raspado

El raspado de listas sigue un enfoque similar al de otros raspados con PHPScraper:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegar a la página de prueba. Esta página contiene:
 *
 * <h2>Ejemplo 1: Lista desordenada</h2>
 * <ul>
 * <li>Lista desordenada elemento 1</li>
 * <li>Integro de la lista desordenada 2</li>.
 * <li>Elemento de lista desordenada con <b>HTML</b></li>.
 * </ul>
 *
 * <h2>Ejemplo 2: Lista ordenada</h2>
 * <ol>
 * <li>Item de la lista ordenada 1</li>.
 * <li>Elemento de la lista ordenada 2</li>.
 * <li>Elemento de lista ordenada con <i>HTML</i></li>
 * </ol>
 */
$web->go('https://test-pages.phpscraper.de/content/lists.html');

var_dump($web->unorderedLists);
/**
 * Sólo listas desordenadas (<ul>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Lista de childNodes
 *     "children_plain" =>
 *     [
 *         "Lista desordenada elemento 1"
 *         "Lista desordenada elemento 2"
 *         "Elemento de lista desordenada con HTML"
 *     ]
 * ]
 */

var_dump($web->orderedLists);
/**
 * Sólo listas ordenadas (<ol>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // Lista de childNodes
 *     "children_plain" =>
 *     [
 *         "Lista ordenada elemento 1"
 *         "Lista ordenada elemento 2"
 *         "Elemento de la lista ordenada con HTML"
 *     ]
 * ]
 */

// Ambas listas combinadas (como la anterior)
var_dump($web->lists);
```

::: warning Listas anidadas
Por el momento, esto no maneja bien las listas anidadas. Para permitir el procesamiento posterior, las listas anidadas se incluyen en el resultado como `hijos`.
:::
