---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Lists

Scraping lists follows a similar approach as other parsing.

```PHP
$web = new \spekulatius\phpscraper();
$web->go('https://test-pages.phpscraper.de/content/lists.html');
/**
 * Navigate to the test page. This page contains:
 *
 * <h2>Example 1: Unordered List</h2>
 * <ul>
 *     <li>Unordered item 1</li>
 *     <li>Unordered item 2</li>
 *     <li>Unordered item with <b>HTML</b></li>
 * </ul>
 *
 * <h2>Example 2: Ordered List</h2>
 * <ol>
 *     <li>Order list item 1</li>
 *     <li>Order list item 2</li>
 *     <li>Order list item with <i>HTML</i></li>
 * </ol>
 *
 * <h2>Example 3: Nested Lists</h2>
 * <ol>
 *     <li>
 *         <ul>
 *             <li>Sub-Item 1</li>
 *             <li>Sub-Item 2</li>
 *         </ul>
 *     </li>
 *     <li>
 *         <ul>
 *             <li>Sub-Item 1</li>
 *             <li>Sub-Item 2</li>
 *         </ul>
 *     </li>
 * </ol>
 */

var_dump($web->unorderedLists);
/**
 * only unordered lists (<ul>)
 *
 *
 *
 *
 */

var_dump($web->orderedLists);
/**
 * only ordered lists (<ol>)
 *
 *
 *
 *
 */

// Both lists combined (as above)
var_dump($web->lists);
```

::: warning Nested Lists
At the moment, this doesn't handle nested lists well. To allow further processing nested lists are included in the result as `children`.
:::
