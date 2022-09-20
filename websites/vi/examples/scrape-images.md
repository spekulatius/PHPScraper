---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập hình ảnh

Bạn có thể tự hỏi làm thế nào để lấy hình ảnh từ một trang web bằng cách sử dụng PHPScraper. Cũng giống các chức năng khác, thu thập hình ảnh từ một trang web theo cách tiếp cận tương tự. Tất cả hình ảnh có thể được lấy và phân tích cú pháp cùng với các chi tiết như thuộc tính thẻ hoặc chỉ dưới dạng danh sách URL.

## Thu thập liên kết hình ảnh

Ví dụ sau đây sẽ trả về các hình ảnh trên trang web dưới dạng mảng URL:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có 2 ảnh:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 *
 * @Note:
 * Có hai cái vì hai ảnh giống nhau:
 * Một ảnh đường dẫn tuyệt đối và một ảnh tương đối.
 * Các đường dẫn tương đối sẽ đổi thành đường dẫn tuyệt đối.
 */
var_dump($web->images);
```

::: tip
Nếu không có hình ảnh nào, mảng sẽ bị rỗng.
:::

## Thu thập hình ảnh với thông tin chi tiết

Nếu bạn muốn lấy thông tin chi tiết về hình ảnh, ví dụ sau sẽ lấy toàn bộ thuộc tính có trong thẻ `img`:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * [
 *     'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'alt' => 'absolute path',
 *     'width' => null,
 *     'height' => null,
 * ],
 * [
 *     'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'alt' => 'relative path',
 *     'width' => null,
 *     'height' => null,
 * ]
 */
var_dump($web->imagesWithDetails);
```

::: tip SEO
Thuộc tính `alt` (với [từ khóa trong nội dung](/vi/examples/extract-keywords.html)) được các công cụ tìm kiếm sử dụng cho các tìm kiếm dựa trên hình ảnh.
:::

## Lấy các thông tin còn thiếu

Nếu bạn muốn lấy thêm các thông tin khác, bạn có thể tạo một pull request hoặc issue trên github về vấn đề này.
