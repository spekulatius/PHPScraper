# Scraping Meta Tags

Access the meta information follows a similar pattern as the previously shown [header tags](/examples/scrape-header-tags). Below is a set of examples:


## Meta Author, Description and Image

The following example shows the extraction of three attributes:

- the Meta Author,
- the Meta Description and
- the Meta Image URL

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Get the information:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```


## Meta Keywords

The keywords meta-tag is naturally an array and will be split for your convience:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="keywords" content="one, two, three">
 */
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// dump the keywords as an array
var_dump($web->keywords);   // ['one', 'two', 'three']
```

Alternatively, you can access the original keyword string:

```php
$web = new \spekulatius\phpscraper();
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Print the keywords as string
echo $web->keywordString;   // "one, two, three"
```


## Combined Meta Tags

If you would like to access all meta properties you can use the `metaTags`-method. It returns the above mentioned methods as an array. It is defined as:

```php
/**
 * get the meta collected as an array
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

From the example above it would be used as following:

```php
$web = new \spekulatius\phpscraper();
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

var_dump($web->metaTags);
/**
 * Contains:
 *
 * [
 *     'Lorem ipsum',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     ['one', 'two', 'three'],
 *     'Lorem ipsum dolor etc.',
 * ]
 */
```


## Missing Meta Tags

If you are in need to access other meta property you can consider [contributing](contributing) to the package or submit an [issue on GitHub](https://github.com/spekulatius/phpscraper/issues).
