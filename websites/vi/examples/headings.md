---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập heading

Heading hữu ích trong việc lấy ý tưởng từ nội dung của trang web. Ví dụ sau sẽ cho thấy cách lấy nó:

 - Một heading
 - Tất cả heading với cấp cụ thể (e.g. `<h3>`)
 - Tất cả heading trên trang

## Thu thập một heading

Thu thập một heading đơn rất dễ dàng và được thực hiện theo ví dụ sau:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <title>Outline Test</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Print the H1 heading
echo $web->h1[0];          // "Outline Test"
```

::: tip
[Tiêu đề trang web](/vi/examples/scrape-website-title.html) và heading 1 (`<h1>`) có thể khác nhau. Đảm bảo rằng bạn truy xuất đúng.
:::

## Heading theo cấp độ

Có thể có những trường hợp, trong đó bạn muốn truy xuất tất cả các heading của một cấp cụ thể. Ví dụ dưới đây cho bạn thấy cách làm như vậy:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * Lấy các heading 3:
 *
 * [
 *    'Example 1',
 *    'Example 2',
 *    'Example 3'
 * ]
 */
$web->h3;
```

Nếu không có heading nào, mảng sẽ rỗng:

## Tất cả heading trên trang

Để lấy toàn bộ heading trên trang, bạn có thể truy cập vào cấp độ từ 1 đến 6. Hoặc bằng cách sử dụng:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này có:
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
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * bây giờ $headings có:
 *
 * [
 *     [
 *         'We are testing here!'
 *     ],
 *     [
 *         'Examples'
 *     ],
 *     [
 *         'Example 1',
 *         'Example 2',
 *         'Example 3',
 *     ],
 *     [],
 *     [],
 *     []
 * ]
 */
$web->headings;
```

Như bạn có thể thấy, phần này không chứa bất kỳ thông tin nào về cấu trúc của các heading. Nó hoàn toàn để biết những heading nào tồn tại. Nếu bạn muốn có một [outline](/vi/examples/outline.html) bạn sẽ cần sử dụng các phương pháp liên quan.
