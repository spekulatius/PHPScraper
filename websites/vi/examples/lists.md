---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Lists&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập danh sách

Thu thập danh sách tương tự như các kiểu thu thập khác với PHPScraper:

```php
$web = new \spekulatius\phpscraper;

/**
 * Chuyển hướng đến trang test, trang này chứa:
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
 * Chỉ danh sách không có thứ tự (<ul>)
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
var_dump($web->unorderedLists);

/**
 * Chỉ danh sách có thứ tự (<ol>)
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
var_dump($web->orderedLists);


// Cả hai danh sách kết hợp (như trên)
var_dump($web->lists);
```

::: warning Danh sách lồng nhau
Hiện tại, danh sách lồng nhau không được hỗ trợ. Danh sách lồng nhau được đính kèm với kết quả dưới dạng `children` để xử lý thêm.
:::
