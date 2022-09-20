---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Meta%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Thu thập thẻ Meta

Việc lấy thẻ meta cũng giống như [thẻ header](/vi/examples/scrape-header-tags.html). Bên dưới là một vài ví dụ:

## Thẻ meta Author, Description và Image

Ví dụ bên dưới sẽ lấy ba thuộc tính:

- thẻ Meta Author,
- thẻ Meta Description and
- thẻ Meta Image URL

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
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

## Meta Keywords

Thẻ meta keywords là một mảng và sẽ được phân chia tùy theo mong muốn của bạn:

```php
$web = new \spekulatius\phpscraper;

/**
 * Điều hướng đến trang test. Trang này chứa:
 *
 * <meta name="keywords" content="one, two, three">
 */
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// in các từ khóa dưới dạng một mảng
var_dump($web->keywords);   // ['one', 'two', 'three']
```

Bạn có thể lấy chuỗi keywords gốc:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// In các từ khóa dưới dạng chuỗi
echo $web->keywordString;   // "one, two, three"
```

::: tip
Điều này chỉ đề cập đến các từ khóa trong thẻ meta "keywords". Bạn cũng có thể sử dụng PHPScraper để [lấy các từ khóa nội dung](/vi/examples/extract-keywords.html)).
:::

## Kết hợp các thẻ meta

Nếu bạn muốn lấy toàn bộ thuộc tính thẻ meta, bạn có thể tạo mới và sử dụng phương thức `metaTags`. Nó sẽ trả về các phương thức đã nhắc bên trên dưới dạng mảng:

```php
/**
 * lấy meta được thu thập dưới dạng một mảng
 *
 * @return array
 */
public function metaTags()
{
    return [
        'author' => $this->author(),
        'image' => $this->image(),
        'keywords' => $this->keywords(),
        'description' => $this->description(),
    ];
}
```

Từ ví dụ trên sẽ được sử dụng như sau:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

var_dump($web->metaTags);
/**
 * Sẽ in:
 *
 * [
 *     'Lorem ipsum',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     ['one', 'two', 'three'],
 *     'Lorem ipsum dolor etc.',
 * ]
 */
```

## Các thẻ Meta bị thiếu

Nếu bạn cần lấy thuộc tính thẻ meta khác, vui lòng đọc [contribution guidelines](/vi/contributing.html) trước khi tạo pull request hoặc [issue trên github](https://github.com/spekulatius/phpscraper/issues).
