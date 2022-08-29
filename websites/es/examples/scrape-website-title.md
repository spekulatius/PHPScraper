---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Website%20Title&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Raspando el título de un sitio web

Raspar el título de un sitio web es sencillo. Los siguientes ejemplos muestran cómo funciona utilizando PHPScraper.


## Ejemplo simple

Ejemplo muy simple de cómo raspar el título de un sitio web:

```php
$web = new \spekulatius\phpscraper;

// Navegue a la página de prueba - ésta sí contiene una etiqueta de título "Lorem Ipsum"
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Contiene:
 *
 * <title>Lorem Ipsum</title>
 */

// Obtener el título. Esto devolverá: "Lorem Ipsum"
var_dump($web->title);
```


## Falta el título

Se devolverá `null` si falta el título:

```php
$web = new \spekulatius\phpscraper;

// Navega a la página de prueba - ésta no contiene una etiqueta de título.
$web->go('https://test-pages.phpscraper.de/meta/missing.html');

// Obtener el título. Esto devolverá null.
var_dump($web->title);
```

Nota: Este es el comportamiento por defecto: Si no se encuentra una etiqueta porque falta en el HTML fuente, se devolverá `null`. Si un elemento iterable está vacío (por ejemplo, si se extraen imágenes de una página sin imágenes), se devolverá un array vacío.


## Caracteres especiales

Cargar el título de un sitio web con la diéresis alemana

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 *  <title>A page with plenty of German umlaute everywhere (ä ü ö)</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

// Imprime el título: "A page with plenty of German umlaute everywhere (ä ü ö)"
echo $web->title;
```

Debería funcionar de forma similar con cualquier carácter UTF-8.


## Entidades HTML

Las entidades HTML deben resolverse

```php
$web = new \spekulatius\phpscraper;

/**
 * Navega hasta la página de la prueba. Contiene:
 *
 * <title>Cat &amp; Mouse</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

// Imprime el título: "Cat & Mouse"
echo $web->title;
```

::: tip CONSEJO
Se han tenido en cuenta las entidades y los caracteres especiales en toda la biblioteca. Si encuentra un lugar donde no funcionan como se espera, por favor, plantee un [problema](https://github.com/spekulatius/PHPScraper/issues).
:::
