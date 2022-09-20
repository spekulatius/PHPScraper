---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Website%20Title&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập tiêu đề trang web

Lấy tiêu đề từ một trang web rất đơn giản. Các ví dụ sau đây cho thấy nó hoạt động như thế nào khi sử dụng PHPScraper.

## Ví dụ đơn giản

Ví dụ rất đơn giản về cách lấy tiêu đề của một trang web:

```php
$web = new \spekulatius\phpscraper;

// Điều hướng đến trang test - trang này có chứa thẻ title "Lorem Ipsum"
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Trang này có:
 *
 * <title>Lorem Ipsum</title>
 */

// Lấy tiêu đề. Sẽ trả về: "Lorem Ipsum"
var_dump($web->title);
```


## Không có tiêu đề

`null` sẽ được trả về nếu tiêu đề không có:

```php
$web = new \spekulatius\phpscraper;

// Điều hướng đến trang test - trang này không có thẻ title.
$web->go('https://test-pages.phpscraper.de/meta/missing.html');

// Lấy tiêu đề. Sẽ trả về null
var_dump($web->title);
```

Ghi chú: Đây là hành vi mặc định: Nếu không tìm thấy thẻ vì thẻ bị thiếu trong mã nguồn HTML, thì `null` sẽ được trả về. Nếu một mục có thể lặp lại trống (ví dụ: cắt các hình ảnh từ một trang không có hình ảnh), một mảng trống sẽ được trả về.

## Ký tự đặc biệt

Lấy tiêu đề trang web bằng tiếng Đức Umlaut

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <title>A page with plenty of German umlaute everywhere (ä ü ö)</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

// In ra title: "A page with plenty of German umlaute everywhere (ä ü ö)"
echo $web->title;
```

Nó cũng hoạt động theo cách tương tự với bất kỳ ký tự UTF-8 nào.

## Thực thể HTML

Các thực thể HTML sẽ được giải quyết

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <title>Cat &amp; Mouse</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

// Sẽ in ra: "Cat & Mouse"
echo $web->title;
```

::: tip
Các thực thể và ký tự đặc biệt đã được duyệt toàn bộ thư viện. Nếu bạn tìm thấy một nơi mà những thứ này không hoạt động như mong đợi, vui lòng gửi [issue](https://github.com/spekulatius/PHPScraper/issues).
:::
