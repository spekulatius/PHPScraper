---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Header%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrape Header Tags

The header tags often contain useful information about a web-page and how it fits into the overall structure of the website it is part of. The following examples show how to access particular pieces of information from the `<head>` and collections around these.


## Charset

To access the defined charset, you can use the following method:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta charset="utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Print the contentType
echo $web->charset;     // "utf-8"
```


## Viewport

In some cases, such as the viewport and the meta keywords, the string is representing an array and will be provided as such:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Get the viewport as an array. It should contain:
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

If you need to access the original string you also access the original string

```php
$web = new \spekulatius\phpscraper();
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Get the viewport as a string. Prints:
 *
 * "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"
 */
echo $web->viewportString;
```


## Canonical URL

The canonical URL, if given, can be accessed as shown in the example below:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
 */
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Print the canonical URL
echo $web->canonical;       // "https://test-pages.phpscraper.de/navigation/2.html"
```

::: tip
If no canonical link is set, the method returns `null`.
:::


## Content Type

To access the content type you can use the following functionality:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Print the contentType
echo $web->contentType;     // "text/html; charset=utf-8"
```


## CSFR Token

The CSFR token method assumes that the token is stored in a meta tag with the name "csrf-token". This is the default for Laravel. You can access it using the following code:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navigate to the test page. It contains:
 *
 * <meta name="csrf-token" content="token" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Get the csrfToken
echo $web->csrfToken;     // "token"
```


## Combined Header Tags

If you want to access all of the above mentioned methods you use the `headers`-method. It is defined as:

```php
/**
 * get the header collected as an array
 *
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

More information on accessing the [meta tags](/examples/scrape-meta-tags.md).