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

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <title>¡Estamos probando aquí!</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Imprimir la cabecera H1
echo $web->h1[0];          // "¡Estamos probando aquí!"
```

::: tip CONSEJO
El [título del sitio web](/es/examples/scrape-website-title) y el encabezado 1 (`<h1>`) pueden ser diferentes. Asegúrese de recuperar el correcto.
:::


## Rúbricas por nivel

Puede haber casos en los que desee recuperar todos los títulos de un nivel determinado. El siguiente ejemplo muestra cómo hacerlo:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <h3>Ejemplo 1</h3>
 * <p>Aquí se vería un ejemplo.</p> <p>
 *
 * <h3>Ejemplo 2</h3>
 * <p>Aquí estaría el segundo ejemplo.</p> <p>
 *
 * <h3>Ejemplo 3</h3>
 * <p>Aquí estaría otro ejemplo.</p> <p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * Obtenga los encabezados h3:
 *
 * [
 *      'Ejemplo 1',
 *      'Ejemplo 2',
 *      'Ejemplo 3'
 * ]
 */
$secondaryHeadings = $web->h3;
```

Si no se encuentra ningún encabezamiento, la matriz se deja vacía.


## Todos los encabezados de una página

Para acceder a todos los encabezados de una página, puede hacerlo accediendo a los diferentes niveles del 1 al 6. O, alternativamente, puede acceder a todos a la vez:


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
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');


$headings = $web->headings;
/**
 * $headings contiene ahora:
 *
 * [
 *     [
 *         '¡Estamos probando aquí!'
 *     ],
 *     [
 *         'Ejemplos'
 *     ],
 *     [
 *         'Ejemplo 1',
 *         'Ejemplo 2',
 *         'Ejemplo 3',
 *     ],
 *     [],
 *     [],
 *     []
 * ]
 */
```

Como puede ver, esto no contiene ninguna información sobre la estructura de los encabezados. Es puramente para saber qué encabezados existen. Si quiere tener un [esquema](/es/examples/outline) tendrá que utilizar los métodos relacionados.
