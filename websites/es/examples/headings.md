---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Recolección de encabezados

Los encabezados pueden ser útiles para hacerse una idea del contenido de un sitio web. El siguiente ejemplo muestra cómo hacer scraping:

 - Un solo encabezado
 - Todos los encabezamientos de un nivel determinado (por ejemplo, `<h3>`)
 - Todos los encabezamientos de una página


## Raspado de un solo encabezado

Raspar un solo encabezado es fácil y se puede hacer siguiendo este ejemplo:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <title>Outline Test</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Imprimir la cabecera H1
echo $web->h1[0];          // "Outline Test"
```

::: tip CONSEJO
El [título del sitio web](/es/examples/scrape-website-title.html) y el encabezado 1 (`<h1>`) pueden ser diferentes. Asegúrese de recuperar el correcto.
:::


## Rúbricas por nivel

Puede haber casos en los que desee recuperar todos los títulos de un nivel determinado. El siguiente ejemplo muestra cómo hacerlo:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
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
 * Obtenga los encabezados h3:
 *
 * [
 *    'Example 1',
 *    'Example 2',
 *    'Example 3'
 * ]
 */
$web->h3;
```

Si no se encuentra ningún encabezamiento, la matriz se deja vacía.


## Todos los encabezados de una página

Para acceder a todos los encabezados de una página, puede hacerlo accediendo a los diferentes niveles del 1 al 6. O, alternativamente, puede acceder a todos a la vez:


```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de la prueba. Esta página contiene:
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
 * $headings contiene ahora:
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

Como puede ver, esto no contiene ninguna información sobre la estructura de los encabezados. Es puramente para saber qué encabezados existen. Si quiere tener un [esquema](/es/examples/outline.html) tendrá que utilizar los métodos relacionados.
