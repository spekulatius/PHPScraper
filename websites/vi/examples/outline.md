---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Trích xuất outline

Đôi khi bạn có thể chỉ muốn lấy [`đề mục`](/vi/examples/headings.html) để xử lý, ví dụ, số lượng hoặc độ dài của các đề mục có thể không phải lúc nào cũng đủ. Trong một số trường hợp, bạn có thể cần xác định cấu trúc thực tế của nội dung. Đối với những trường hợp sử dụng này, bạn có thể muốn xem xét một trong những phương pháp sau:

 - `outline` hoạt động tương tự như phương pháp `đề mục` đã đề cập trước đó. Nó cũng trả về tất cả các đề mục, nhưng nó giữ nguyên cấu trúc của tài liệu gốc và cung cấp các cấp đề mục (ví dụ: `h1`) một mình với đầu ra.

 - `outlineWithParagraphs` hoạt động tương tự như `outline`, sự khác biệt là phương thức này cũng bao gồm các đoạn văn.

 - `cleanOutlineWithParagraphs` hoạt động tương tự như `outlineWithParagraphs`, sự khác biệt bất kỳ thẻ HTML trống nào sẽ bị xóa.

Các ví dụ sau đây sẽ giúp hiểu rõ hơn về chức năng. Có các phương pháp dành riêng cho [trích xuất từ khóa](/vi/examples/extract-keywords.html).

## Trích xuất Outline

Dàn ý của nội dung cho phép bạn xây dựng một chỉ mục của tài liệu. Ví dụ sau đây tạo một phiên bản đánh dấu xuống của các đề mục trong tài liệu được yêu cầu:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <h1>We are testing here!</h1>
 * [...]
 *
 * <h2>Examples</h2>
 * [...]
 *
 * <h3>Example 1</h3>
 * [...]
 *
 * <h3>Example 2</h3>
 * [...]
 *
 * <h3>Example 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

/**
 * $outline sẽ thành:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ]
 * ]
 */
$outline = $web->outline;
```

## Trích xuất Outline với đoạn văn

Phương thức sau hoạt động theo cách tương tự như `outline`, nhưng nó cũng bao gồm bất kỳ đoạn nào như một phần của mảng được trả về:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <h1>We are testing here!</h1>
 * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
 *
 * <h2>Examples</h2>
 * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

$content = $web->outlineWithParagraphs;
/**
 * bây giờ $content chứa:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```

## Trích xuất Outline đã cleanup với đoạn văn

Phương pháp sau hoạt động theo cách tương tự như `outlineWithParagraphs`, nhưng nó không bao gồm bất kỳ tiêu đề hoặc đoạn văn nào trống như một phần của mảng được trả về:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <h1>We are testing here!</h1>
 * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
 *
 * <h2>Examples</h2>
 * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

$content = $web->cleanOutlineWithParagraphs;
/**
 * bây giờ $content chứa:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ]
 * ]
 */
```
