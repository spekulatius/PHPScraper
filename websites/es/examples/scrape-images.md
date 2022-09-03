---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Raspado de imágenes

Puede que te preguntes cómo raspar fotos, imágenes y otros gráficos de un sitio web utilizando PHPScraper. Al igual que con otras funcionalidades, el scraping de imágenes &amp; fotos de un sitio web sigue un enfoque similar. Todos los gráficos como imágenes, fotos e infografías pueden ser raspados y analizados junto con detalles como atributos de etiquetas o sólo como una lista de URL.


## Scraping Image URLs

El siguiente ejemplo analiza una página web en busca de imágenes y devuelve las URLs absolutas de las imágenes como un array.

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue a la página de prueba. Esta página contiene dos imágenes:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 *
 * @Nota:
 * Doble porque es dos veces la misma imagen:
 * Una con una ruta relativa y otra con una ruta absoluta.
 * Las rutas relativas se resuelven en rutas absolutas por defecto.
 */
var_dump($web->images);
```

::: tip CONSEJO
Si no se encuentra ninguna imagen, la matriz queda vacía.
:::


## Raspado de imágenes con detalles

Si necesita más detalles, las siguientes peticiones le permiten acceder a los atributos de la etiqueta de la imagen:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

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
var_dump($web->imagesWithDetails);
```

::: tip SEO
El texto `alt` (con las [palabras clave del contenido](/es/examples/extract-keywords.html)) es utilizado por los motores de búsqueda para las búsquedas basadas en imágenes. Asegúrese de definirlo siempre.
:::


## Atributos de raspado: Alt, Anchura y Altura

Los atributos para `alt`, `width` y `height` están incluidos en el conjunto de datos detallados.

Si necesita más datos, tendrá que ampliar la biblioteca o enviar una incidencia para su consideración.
