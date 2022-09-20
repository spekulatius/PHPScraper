---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Social%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập thẻ Meta mạng xã hội

Thu thập các thẻ meta chia sẻ mạng xã hội từ trang web bằng các phương thức sau. Kết quả phụ thuộc vào thẻ được cung cấp. Tất cả các thẻ đều được bao gồm, miễn là chúng nằm trong không gian tên có tiền tố (ví dụ: `twitter` dành cho Twitter Card).

## Dữ liệu Open-Graph (OG)

Lấy dữ liệu open-graph có thể làm như sau:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <!-- open graph example -->
 * <meta property="og:site_name" content="Lorem ipsum" />
 * <meta property="og:type" content="website" />
 * <meta property="og:title" content="Lorem Ipsum" />
 * <meta property="og:description" content="Lorem ipsum dolor etc." />
 * <meta property="og:url" content="https://test-pages.phpscraper.de/meta/lorem-ipsum.html" />
 * <meta property="og:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/og/example.html
 */
$web->go('https://test-pages.phpscraper.de/og/example.html');

// Sẽ in ra 'Lorem Ipsum'
echo $web->openGraph['og:title'];

// Sẽ in ra 'Lorem ipsum dolor etc.'
echo $web->openGraph['og:description'];

// toàn bộ:
$data = $web->openGraph;

/**
 * bây giờ $data có:
 *
 * [
 *     'og:site_name' => 'Lorem ipsum',
 *     'og:type' => 'website',
 *     'og:title' => 'Lorem Ipsum',
 *     'og:description' => 'Lorem ipsum dolor etc.',
 *     'og:url' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
 *     'og:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

::: tip
Nếu không có dữ liệu, mạng sẽ trả về rỗng.
:::

## Twitter Card

Phân tích cú pháp Twitter Card hoạt động tương tự

```php
$web = new \spekulatius\phpscraper;

/**
 * Chuyển hướng đến trang test. Trang chứa các Twitter Card như sau:
 *
 * <!-- Twitter card -->
 * <meta name="twitter:card" content="summary_large_image" />
 * <meta name="twitter:title" content="Lorem Ipsum" />
 * <meta name="twitter:description" content="Lorem ipsum dolor etc." />
 * <meta name="twitter:url" content="https://test-pages.phpscraper.de/meta/lorem-ipsum.html" />
 * <meta name="twitter:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/twittercard/example.html
 */
$web->go('https://test-pages.phpscraper.de/twittercard/example.html');

// In ra 'summary_large_image'
echo $web->twitterCard['twitter:card'];

// In ra 'Lorem Ipsum'
echo $web->twitterCard['twitter:title'];

// Toàn bộ.
$data = $web->twitterCard;

/**
 * $data chứa:
 *
 * [
 *     'twitter:card' => 'summary_large_image',
 *     'twitter:title' => 'Lorem Ipsum',
 *     'twitter:description' => 'Lorem ipsum dolor etc.',
 *     'twitter:url' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
 *     'twitter:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

Tương tự như Open Graph, mảng sẽ trống nếu không tìm thấy thẻ Twitter Card.
