---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Lists

Scraping lists follows a similar approach as other scraping:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. This page contains:
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

var_dump($web->unorderedLists);
/**
 * Only unordered lists (<ul>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // List of childNodes
 *     "children_plain" =>
 *     [
 *         "Unordered list item 1"
 *         "Unordered list item 2"
 *         "Unordered list item with HTML"
 *     ]
 * ]
 */

var_dump($web->orderedLists);
/**
 * Only ordered lists (<ol>)
 *
 * [
 *     "type" => "ul",
 *     "children" => ... // List of childNodes
 *     "children_plain" =>
 *     [
 *         "Ordered list item 1"
 *         "Ordered list item 2"
 *         "Ordered list item with HTML"
 *     ]
 * ]
 */

// Both lists combined (as above)
var_dump($web->lists);
```

::: warning Nested Lists
At the moment, this doesn't handle nested lists well. To allow further processing nested lists are included in the result as `children`.
:::
