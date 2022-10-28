---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập liên kết

Thu thập liên kết hoạt động tương tự như [thu thập hình ảnh](/vi/examples/scrape-images.html. Bạn có thể lấy danh sách URL mà không có bất kỳ thông tin bổ sung nào cũng như danh sách chi tiết chứa `rel`, ` target` hay các thuộc tính khác.

## Danh sách liên kết đơn giản

Ví dụ sau phân tích trang web cho các liên kết và trả về một loạt các URL tuyệt đối:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Có 6 liên kết placekitten.com với các thuộc tính khác nhau:
 *
 * <h2>Different ways to wrap the attributes</h2>
 * <p><a href="https://placekitten.com/408/287" target=_blank>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="_blank">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='_blank'>external kitten</a></p>
 *
 * <h2>Named frame/window/tab</h2>
 * <p><a href="https://placekitten.com/408/287" target=kitten>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="kitten">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='kitten'>external kitten</a></p>
 */
$web->go('https://test-pages.phpscraper.de/links/target.html');

// Số lượng liên kết.
echo "This page contains " . count($web->links) . " links.\n\n";

// Lặp qua các liên kết
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Kết hợp điều này sẽ in ra:
 *
 * This page contains 6 links.
 *
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 */
```

Nếu trang không được chứa bất kỳ liên kết nào, một mảng trống sẽ được trả về.

## Liên kết và chi tiết

Nếu bạn cần thêm thông tin chi tiết, bạn có thể truy cập chúng theo cách tương tự như trên hình ảnh. Dưới đây là ví dụ để truy cập dữ liệu chi tiết của liên kết đầu tiên trên trang:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa một số liên kết với các thuộc tính rel khác nhau. Để tiết kiệm dung lượng, chỉ lấy link đầu tiên:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Lấy liên kết đầu tiên trên trang.
$firstLink = $web->linksWithDetails[0];

/**
 * bây giờ $firstLink có:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'protocol' => 'https',
 *     'text' => 'external kitten',
 *     'title' => null,
 *     'target' => null,
 *     'rel' => 'nofollow',
 *     'isNofollow' => true,
 *     'isUGC' => false,
 *     'isNoopener' => false,
 *     'isNoreferrer' => false,
 * ]
 */
```

Nếu bạn yêu cầu nhiều dữ liệu hơn, bạn sẽ cần phải mở rộng thư viện hoặc gửi issue để cùng thảo luận.

## Liên kết nội bộ và liên kết bên ngoài

PHPScraper chỉ cho phép trả về các liên kết bên trong hoặc bên ngoài. Xem các vị dụ sau:

```php
$web = new \spekulatius\phpscraper;

// Điều hướng đến trang test.
$web->go('https://test-pages.phpscraper.de/links/base-href.html');

// Lấy tất cả liên kết nội bộ (trong ví dụ một hình ảnh được liên kết)
var_dump($web->internalLinks);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg'
 * ]
 */

// Lấy tất cả liên kết bên ngoài
var_dump($web->externalLinks);
/**
 * [
 *     'https://placekitten.com/408/287'
 * ]
 */
```
