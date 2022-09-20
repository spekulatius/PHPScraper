---
image: https://api.imageee.com/bold?text=PHP:%20Extract%20Keywords&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Trích xuất từ ​​khóa

Đôi khi bạn có thể cần trích xuất các thuật ngữ và cụm từ (keywords) quan trọng trong nội dung này. PHPScraper cho phép bạn trích xuất các từ khóa của trang web một cách trực tiếp. Để làm được nó sử dụng các:

- tiêu đề trang web,
- thẻ meta,
- tất cả heading,
- đoạn văn trên trang,
- liên kết
- thuộc tính title của ảnh

Mặc dù các cụm từ khóa này được trích xuất, điều đó không có nghĩa là trang thực sự xếp hạng cho các từ khóa này. Quyết định cuối cùng về việc xếp hạng từ khóa của một trang web là với công cụ tìm kiếm.

Ví dụ sau sẽ trả về danh sách tất cả các từ khóa được trích xuất từ ​​trang web:

```php
$web = new \spekulatius\phpscraper;

// Chuyển hướng đến trang test.
// Nó chứa 3 đoạn văn từ bài viết Wikipedia tiếng Anh cho "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// số lượng từ khóa.
$keywords = $web->contentKeywords;
echo "Trang này chứa " . count($keywords) . " từ khóa.\n\n";

// lặp các từ khóa
foreach ($keywords as $keyword) {
    echo " - " . $keyword . "\n";
}

/**
 * Nó sẽ hiển thị:
 *
 * Trang này chứa 40 từ khóa.
 *
 * [...]
 * - graphic
 * - improper latin
 * - introduced
 * - keyword extraction tests
 * - letraset transfer sheets
 * - lorem ipsum
 * - lorem ipsum    php rake library  lorem ipsum
 * - lorem ipsum text
 * - make
 * - malorum
 * - microsoft word
 * - mid-1980s
 * - nonsensical
 * - page
 * - paragraphs
 * - philosopher cicero
 * - php rake library
 * - popular word processors including pages
 * - popularized
 * - removed
 * - roman statesman
 * - source
 * [...]
 */
```

::: tip
Ngôn ngữ mặc định (locale) là `en_US`. Các ngôn ngữ khác có thể được truyền dưới dạng tham số. Điều này hiện chỉ hoạt động cho một số ngôn ngữ. Xem [danh sách này](https://github.com/Donatello-za/rake-php-plus#currently-supported-languages) để biết thêm chi tiết.
:::

## Chấm điểm từ khóa

Không phải mọi từ khóa đều có điểm số như nhau trong thuật toán xếp hạng của các công cụ tìm kiếm. Sự kết hợp của một số yếu tố và tín hiệu SEO quyết định trọng lượng mà công cụ tìm kiếm gán cho một từ. Tần suất của từ, độ dài của văn bản và các biến thể như từ đồng nghĩa có thể dẫn đến trọng số khác nhau.

PHPScraper cho phép bạn lấy điểm số của từ khóa:

```php
$web = new \spekulatius\phpscraper;

// Điều hướng đến trang test.
// Nó chứa 3 đoạn văn từ bài viết Wikipedia tiếng Anh cho "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// kiểm tra số lượng từ khóa.
$keywords = $web->contentKeywordsWithScores;
echo "Trang này chứa " . count($keywords) . " từ khóa.\n\n";

// Loop through the keywords
foreach ($keywords as $keyword => $score) {
    echo sprintf(" - %s (%s)\n", $keyword, $score);
}

/**
 * Sẽ in ra:
 *
 * Trang này chứa 40 từ khóa.
 *
 * [...]
 *  - 1960s (1.0)
 *  - added (1.0)
 *  - adopted lorem ipsum (11.0)
 *  - advertisements (1.0)
 *  - aldus employed (4.0)
 *  - corrupted version (4.0)
 *  - graphic (1.0)
 *  - improper latin (4.0)
 *  - introduced (1.0)
 *  - keyword extraction tests (9.0)
 *  - test (1.0)
 *  - microsoft word (5.3333333333333)
 *  - english wikipedia (4.0)
 *  - lorem ipsum (8.0)
 *  - lorem ipsum text (11.0)
 * [...]
 */
```

::: tip
Hàm PHP [similar_text](https://www.php.net/manual/en/function.similar-text.php) và [levenshtein](https://www.php.net/manual/en/function.levenshtein.php) có thể giúp bạn xác định và hợp nhất các từ khóa tương tự cũng như các biến thể lỗi đánh máy của từ khóa. [Keyword Merge](https://github.com/spekulatius/keyword-merge) là một thư viện composer để giúp phân loại các từ khóa tương tự.
:::
