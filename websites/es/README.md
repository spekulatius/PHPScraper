---
image: https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

Una librería *opinante* de web-scraping para PHP
===========================================

*por [Peter Thaleikis](https://peterthaleikis.com)*

El raspado de la web usando PHP puede hacerse más fácilmente. Esta es una envoltura de opinión alrededor de algunas grandes bibliotecas de PHP para hacer el acceso a la web más fácil.

Los ejemplos cuentan la historia mucho mejor. Echa un vistazo.


La idea 💡️
----------

Acceder a sitios web y recoger información básica de la web es demasiado complejo. Esta envoltura alrededor de [Goutte](https://github.com/FriendsOfPHP/Goutte) lo hace más fácil. Te ahorra el uso de XPath y demás, dándote acceso directo a todo lo que necesitas. Web scraping con PHP reimaginado.


Apoyos 💪️
-------------

Este proyecto está patrocinado por:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

¿Quieres patrocinar este proyecto? [Póngase en contacto conmigo](https://peterthaleikis.com/contact).


Ejemplos
--------

Aquí hay algunos ejemplos de lo que la biblioteca de raspado web puede hacer en este momento:

### Scrape Meta Information:

```php
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Obtener la información:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```

El resto de la información se puede acceder directamente, ya sea como cadena o como matriz.


### Raspado de contenidos, como imágenes:

```PHP
$web = new \spekulatius\phpscraper();

/**
 * Navegue hasta la página de prueba. Esta página contiene dos imágenes:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
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
```

Alguna información *opcionalmente* se devuelve como un array con detalles. Para este ejemplo, una simple lista de imágenes está disponible usando `$web->images` también. Esto debería facilitar el raspado de la web.

Puede encontrar más código de ejemplo en la barra lateral o en las pruebas.


Instalación
------------

Como siempre, se hace a través de Composer:

```bash
composer require spekulatius/phpscraper
```

Esto asegura automáticamente que el paquete se cargue y puedas empezar a raspar la web. Ahora puede utilizar cualquiera de los ejemplos anotados.


Contribuyendo a
------------

Impresionante, si quieres contribuir por favor revisa las [directrices](/contributing) antes de empezar.


Pruebas
-----

El código está cubierto a grandes rasgos con pruebas de extremo a extremo. Para ello, se alojan páginas web sencillas en *https://test-pages.phpscraper.de/*, cargado y analizado usando [PHPUnit](https://phpunit.de/). Estas pruebas también son adecuadas como ejemplos - véase`tests/`!

Dicho esto, es probable que haya casos límite que no funcionen y puedan causar problemas. Si encuentras uno, por favor, levanta un bug en GitHub.
