---
image: https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

PHP Scraper: Thu thập thông tin và cào dữ liệu dễ dàng
==============================================================

![PHP Scraper: Thu thập thông tin và cào dữ liệu dễ dàng](logo-light.png)

*bởi [Peter Thaleikis](https://peterthaleikis.com)*

PHPScraper là một thư viện cào dành cho PHP, đơn giản. Thư viện này sử dụng vài thư viện PHP làm cho việc lấy dữ liệu trang web dễ dàng hơn.

Các ví dụ kể câu chuyện hay hơn nhiều. Hãy xem!

Ý tưởng 💡️
----------

Việc truy cập và lấy các thông tin cơ bản của trang web rất phức tạp. Wrapper [Goutte](https://github.com/FriendsOfPHP/Goutte) này giúp việc này trở nên dễ dàng hơn. Nó giúp bạn tiết kiệm khỏi XPath và đồng., Cho phép bạn truy cập trực tiếp vào mọi thứ bạn cần. Hình dung lại trang web bằng PHP.

Nhà tài trợ 💪️
-------------

Dự án này được tài trợ bởi:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Muốn tài trợ cho dự án này? [Liên hệ](https://peterthaleikis.com/contact).


Một vài ví dụ
-------------

Dưới đây là một số ví dụ về những gì mà thư viện cào web hiện có thể làm:

### Cào thông tin meta:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Lấy thông tin:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```

Gần như mọi thông tin đều có thể lấy được trực tiếp, dưới dạng chuỗi hoặc mảng.


### Cào nội dung, như hình ảnh

```php
$web = new \spekulatius\phpscraper;

/**
 * Navigate to the test page. This page contains two images:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
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
```

Một số thông tin *tùy chọn* được trả về dưới dạng một mảng với các chi tiết. Đối với ví dụ này, bạn có thể lấy danh sách hình ảnh bằng `$web->images`. Điều này sẽ làm cho việc tìm kiếm trang web của bạn dễ dàng hơn.

Có thể tìm thấy thêm code ví dụ trong các `examples` và `tests`.

Cài đặt
------------

Sử dụng [Composer](https://getcomposer.org) để cài đặt.

### Cài bằng Composer

```bash
composer require spekulatius/phpscraper
```

Sau khi cài xong, thư viện sẽ được thêm vào bởi autoloader của Composer. 
After the installation is completed the package will be picked up by the Composer autoloader. Trong các ứng dụng và framework PHP điển hình như Laravel hoặc Symfony, bạn có thể bắt đầu cào ngay bây giờ. Bây giờ bạn có thể sử dụng bất kỳ ví dụ hoặc ví dụ nào được lưu ý trong thư mục `tests/`.

### Sử dụng trong dự án PHP thuần

Nếu bạn đang làm trong dự án PHP thuần, bạn cần phải include autoloader vào đầu tệp PHP;

```php
require 'vendor/autoload.php';
```

Nếu bạn đang sử dụng framework như Laravel, Symfony, Zend, Phalcon hoặc CakePHP, bạn không cần làm bước này. Autoloader sẽ được đưa vào tự động.

Tìm thấy lỗi và muốn sửa nó? Tuyệt vời!
----------------------------------

Trước khi bắt đầu, hãy đọc qua [hướng dẫn đóng góp](/contributing.html). Mọi thắc mắc vui lòng liên hệ.

Tests: Đảm bảo nó hoạt động!
----------------------------

The code is roughly covered with end-to-end tests. For this, simple web-pages are hosted under *https://test-pages.phpscraper.de/*, loaded and parsed using [PHPUnit](https://phpunit.de/). These tests are also suitable as examples - see `tests/`!

Điều này đang được nói, có lẽ có những trường hợp cạnh không hoạt động và có thể gây ra sự cố. Nếu bạn tìm thấy một lỗi, vui lòng nêu ra một lỗi trên GitHub.
