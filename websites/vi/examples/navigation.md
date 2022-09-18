---
image: https://api.imageee.com/bold?text=PHP:%20Navigate%20while%20Scraping&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Điều hướng

Đa số là PHPScraper phân tích và thu thập nội dung trang web, thì bạn có thể sử dụng nó để điều hướng trang web. Các ví dụ bên dưới sẽ cho bạn thấy cách *lướt* quanh trang web.

## Sử dụng URL để điều hướng

Bạn có thể điều hướng bất kỳ URL nào. Các URL này thường được lấy từ [phân tích liên kết](/examples/scrape-links.html).

```php
$web = new \spekulatius\phpscraper;

// We start on test page #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #1'


// We navigate to the test page #2 using the absolute URL.
$web->clickLink('https://test-pages.phpscraper.de/navigation/2.html');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #2'
```


## Sử dụng Anchor Texts để điều hướng

Bạn có thể sử dụng anchor text trên trang web để *nhấn* vào liên kết để điều hướng:

```php
$web = new \spekulatius\phpscraper;

// We start on test page #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

/**
 * This page contains:
 *
 * <a href="2.html">2 relative</a>
 */

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #1'


// We navigate to the test page #2 using the text it has on the page.
$web->clickLink('2 relative');

// Print the title to see if we actually at the right page...
echo $web->h1[0];   // 'Page #2'
```

Chức năng cơ bản này sẽ cho phép bạn điều hướng các trang web.