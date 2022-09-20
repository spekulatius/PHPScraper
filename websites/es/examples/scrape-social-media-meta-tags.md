---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Social%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Social Media Meta Tags

El raspado de las etiquetas de compartición de las redes sociales de un sitio web puede realizarse mediante los siguientes métodos. El conjunto exacto de resultados depende de las etiquetas proporcionadas. Se incluyen todas las etiquetas, siempre que estén en el espacio de nombres prefijado (por ejemplo, `twitter:` para Twitter Cards).


## Datos de Open-Graph (OG)

Se pueden obtener datos de gráficos abiertos:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegar a la página de la prueba. La página contiene:
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

// Debería imprimirse 'Lorem Ipsum'
echo $web->openGraph['og:title'];

// Debería imprimir "Lorem ipsum dolor etc.
echo $web->openGraph['og:description'];

// Todo el conjunto:
$data = $web->openGraph;

/**
 * $data ahora contiene:
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

::: tip CONSEJO
Si no se encuentran datos, el array se devolverá vacío.
:::


## Twitter Card

El análisis de la Twitter Card funciona de forma similar:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue a la página de prueba. La página contiene la siguiente tarjeta de Twitter:
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

// Debería imprimirse 'summary_large_image'
echo $web->twitterCard['twitter:card'];

// Debería imprimirse 'Lorem Ipsum'
echo $web->twitterCard['twitter:title'];

// Todo el conjunto.
$data = $web->twitterCard;

/**
 * $data contiene ahora:
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

De forma similar a Open Graph, la matriz estará vacía si no se han encontrado etiquetas de Twitter Card.
