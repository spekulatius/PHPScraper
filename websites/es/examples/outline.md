---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Exportación de contenidos

Si bien es posible que quiera acceder sólo a los [`encabezados`](/examples/headings) para procesar, por ejemplo, el número o la longitud de los epígrafes, no siempre es suficiente. En algunos casos puede ser necesario identificar la estructura real del contenido. Para estos casos de uso, puede considerar uno de estos métodos:

 - `outline` funciona de forma similar al método `headings` mencionado anteriormente. También devuelve todos los encabezados, pero mantiene la estructura del documento original en su lugar y proporciona los niveles de encabezado (por ejemplo, `h1`) solo con la salida.

 - El método `outlineWithParagraphs` funciona de forma similar a `outline`, con la diferencia de que esta llamada también incluye los párrafos.

 - CleanOutlineWithParagraphs` funciona de forma similar a `outlineWithParagraphs`, con la diferencia de que se eliminan las etiquetas HTML vacías.

Los siguientes ejemplos deberían ayudar a entender mejor la funcionalidad. Hay métodos dedicados para la [extracción de palabras clave](/examples/extract-keywords) disponibles.


## Exportar el esquema

El esquema del contenido permite construir un índice del documento. El siguiente ejemplo construye una versión markdown de los encabezados del documento solicitado:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de la prueba. Esta página contiene:
 *
 * <h1>¡Estamos probando aquí!</h1>
 * [...]
 *
 * <h2>Ejemplos</h2>
 * [...]
 *
 * <h3>Ejemplo 1</h3>
 * [...]
 *
 * <h3>Ejemplo 2</h3>
 * [...]
 *
 * <h3>Ejemplo 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$outline = $web->outline;
/**
 * $outline ahora contiene:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "¡Estamos probando aquí!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Ejemplos"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 3"
 *    ]
 * ]
 */
```


## Exportar el esquema con párrafos

El siguiente método funciona de manera similar a `outline`, pero también incluye los párrafos como parte del array devuelto:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de la prueba. Esta página contiene:
 *
 * <h1>¡Aquí estamos probando!</h1>
 * <p>Esta página contiene una estructura de ejemplo para ser analizada. Viene con una serie de encabezados y párrafos anidados como ejemplo de scrape.</p>
 *
 * <h2>Ejemplos</h2>
 * <p>Hay numerosos ejemplos en el sitio web. Por favor, compruébalos para obtener más contexto sobre cómo funciona el scraping.</p> <p>
 *
 * <h3>Ejemplo 1</h3>
 * <p>Aquí hay un ejemplo.</p> <p>
 *
 * <h3>Ejemplo 2</h3>
 * <p>Aquí estaría el segundo ejemplo.</p> <p>
 *
 * <h3>Ejemplo 3</h3>
 * <p>Aquí estaría otro ejemplo.</p> <p>
 *

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
 *      "content" =>  "¡Estamos probando aquí!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Esta página contiene una estructura de ejemplo para ser analizada. Viene con una serie de encabezados y párrafos anidados como ejemplo de raspado."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Ejemplos"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Hay numerosos ejemplos en el sitio web. Consúltalos para saber cómo funciona el scraping."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Este sería un ejemplo."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Este sería el segundo ejemplo."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Este sería otro ejemplo."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```


## Exportar el esquema limpiado con párrafos

El siguiente método funciona de manera similar a `outlineWithParagraphs`, pero no incluye ningún encabezado o párrafo vacío como parte del array devuelto:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de la prueba. Esta página contiene:
 *
 * <h1>¡Aquí estamos probando!</h1>
 * <p>Esta página contiene una estructura de ejemplo para ser analizada. Viene con una serie de encabezados y párrafos anidados como ejemplo de scrape.</p>
 *
 * <h2>Ejemplos</h2>
 * <p>Hay numerosos ejemplos en el sitio web. Por favor, compruébalos para obtener más contexto sobre cómo funciona el scraping.</p> <p>
 *
 * <h3>Ejemplo 1</h3>
 * <p>Aquí hay un ejemplo.</p> <p>
 *
 * <h3>Ejemplo 2</h3>
 * <p>Aquí estaría el segundo ejemplo.</p> <p>
 *
 * <h3>Ejemplo 3</h3>
 * <p>Aquí estaría otro ejemplo.</p> <p>
 *
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
 *      "content" =>  "¡Estamos probando aquí!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Esta página contiene una estructura de ejemplo para ser analizada. Viene con una serie de encabezados y párrafos anidados como ejemplo de raspado."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Ejemplos"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Hay numerosos ejemplos en el sitio web. Consúltalos para saber cómo funciona el scraping."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "He aquí un ejemplo."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Este sería el segundo ejemplo."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Ejemplo 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Este sería otro ejemplo."
 *    ]
 * ]
 */
```
