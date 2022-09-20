---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Header%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập thẻ Header

Thẻ header thường chứa các thông tin hữu ích về trang web. Các ví dụ dưới đây sẽ cho thấy cách lấy các thông tin cụ thể từ thẻ `head`.

## Charset

Để lấy `charset` đã khai báo, bạn có thể sử dụng phương thức sau:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
 *
 * <meta charset="utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// In charset
echo $web->charset;     // "utf-8"
```

## Viewport

Trong vài trường hợp, như viewport và các từ khóa meta, chuỗi sẽ được chuêynr thành mảng và được cung cấp như sau:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
 *
 * <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Lấy viewport dưới dạng mạng, nó sẽ in:
 *
 * [
 *     'width=device-width',
 *     'initial-scale=1',
 *     'shrink-to-fit=no',
 *     'maximum-scale=1',
 *     'user-scalable=no'
 * ],
 */
var_dump($web->viewport);
```

Nếu bạn cần lấy chuỗi gốc của "viewport", bạn có thể sử dụng `viewportString`:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Lấy viewport dưới dạng string, nó sẽ in:
 *
 * "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"
 */
echo $web->viewportString;
```

## Canonical URL

Nếu URL chuẩn được tìm tháy, có thể lấy theo ví dụ bên dưới:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
 *
 * <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
 */
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// In URL canonical
echo $web->canonical;       // "https://test-pages.phpscraper.de/navigation/2.html"
```

::: tip
Nếu không có liên kết chuẩn nào, phương thức sẽ trả về `null`.
:::

## Content-Type

Bạn có thể lấy kiểu nội dung của trang web bằng cách sử dụng `contentType`:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
 *
 * <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// In contentType
echo $web->contentType;     // "text/html; charset=utf-8"
```

## CSFR Token

Đối với Laravel, mã token CSRF thường nằm trong thẻ meta có tên là `csrf-token`. Bạn có thể lấy nó bằng cách sử dụng `csrfToken`:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
 *
 * <meta name="csrf-token" content="token" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Lấy csrfToken
echo $web->csrfToken;     // "token"
```

## Kết hợp các thẻ header lại

Nếu bạn muốn lấy toàn bộ các thẻ header đã nói bên trên bằng phương thức `headers()`. Có thể làm theo như sau:

```php
/**
 * @return array
 */
public function headers()
{
    return [
        'charset' => $this->charset(),
        'contentType' => $this->contentType(),
        'viewport' => $this->viewport(),
        'canonical' => $this->canonical(),
        'csrfToken' => $this->csrfToken(),
    ];
}
```

Xem thêm thông tin về cách lấy [thẻ meta](/vi/examples/scrape-meta-tags.html).
