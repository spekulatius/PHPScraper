---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Extracción de contornos

Si bien es posible que quiera acceder sólo a los [`encabezados`](/es/examples/headings.html) para procesar, por ejemplo, el número o la longitud de los epígrafes, no siempre es suficiente. En algunos casos puede ser necesario identificar la estructura real del contenido. Para estos casos de uso, puede considerar uno de estos métodos:

 - `outline` funciona de forma similar al método `headings` mencionado anteriormente. También devuelve todos los encabezados, pero mantiene la estructura del documento original en su lugar y proporciona los niveles de encabezado (por ejemplo, `h1`) solo con la salida.

 - El método `outlineWithParagraphs` funciona de forma similar a `outline`, con la diferencia de que esta llamada también incluye los párrafos.

 - `CleanOutlineWithParagraphs` funciona de forma similar a `outlineWithParagraphs`, con la diferencia de que se eliminan las etiquetas HTML vacías.

Los siguientes ejemplos deberían ayudar a entender mejor la funcionalidad. Hay métodos dedicados para la [extracción de palabras clave](/es/examples/extract-keywords.html) disponibles.


## Extraer el esquema

El esquema del contenido permite construir un índice del documento. El siguiente ejemplo construye una versión markdown de los encabezados del documento solicitado:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de la prueba. Esta página contiene:
 *
 * <h1>We are testing here!</h1>
 * [...]
 *
 * <h2>Examples</h2>
 * [...]
 *
 * <h3>Example 1</h3>
 * [...]
 *
 * <h3>Example 2</h3>
 * [...]
 *
 * <h3>Example 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

/**
 * $outline se establecerá para que contenga:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ]
 * ]
 */
$outline = $web->outline;
```


## Extraer el esquema con párrafos

El siguiente método funciona de manera similar a `outline`, pero también incluye los párrafos como parte del array devuelto:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->outlineWithParagraphs;
/**
 * $content ahora contiene:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```


## Extraer el esquema depurado con los párrafos

El siguiente método funciona de manera similar a `outlineWithParagraphs`, pero no incluye ningún encabezado o párrafo vacío como parte del array devuelto:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->cleanOutlineWithParagraphs;
/**
 * $content ahora contiene:
 *
  * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ]
 * ]
 */
```
