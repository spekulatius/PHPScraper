---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Enlaces de raspado

El scraping de enlaces funciona de forma muy similar al [image scraping](/es/examples/scrape-images.html). Puede recuperar una lista de URL sin ninguna información adicional, así como una lista detallada que contenga `rel`, `target` así como otros atributos.


## Lista de enlaces simples

El siguiente ejemplo analiza una página web en busca de enlaces y devuelve un array de URLs absolutas:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de prueba. Contiene 6 enlaces a placekitten.com con diferentes atributos:
 *
 * <h2>Different ways to wrap the attributes</h2>
 * <p><a href="https://placekitten.com/408/287" target=_blank>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="_blank">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='_blank'>external kitten</a></p>
 *
 * <h2>Named frame/window/tab</h2>
 * <p><a href="https://placekitten.com/408/287" target=kitten>external kitten</a></p>
 * <p><a href="https://placekitten.com/444/333" target="kitten">external kitten</a></p>
 * <p><a href="https://placekitten.com/444/321" target='kitten'>external kitten</a></p>
 */
$web->go('https://test-pages.phpscraper.de/links/target.html');

// Imprime el número de enlaces.
echo "Esta página contiene " . count($web->links) . " enlaces.\n\n";

// Recorrer los enlaces en bucle
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Combinado esto se imprimirá:
 *
 * Esta página contiene 6 enlaces.
 *
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 */
```

Si la página no debe contener ningún enlace, se devuelve un array vacío.


## Enlaces con detalles

Si necesitas más detalles puedes acceder a ellos de forma similar a como se hace en las imágenes. A continuación se muestra un ejemplo para acceder a los datos detallados del primer enlace de la página:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de prueba. Esta página contiene varios enlaces con diferentes atributos rel. Para ahorrar espacio sólo el primero:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Obtener el primer enlace de la página.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink contiene ahora:
 *
 * [
 *     'url' => 'https://placekitten.com/432/287',
 *     'protocol' => 'https',
 *     'text' => 'external kitten',
 *     'title' => null,
 *     'target' => null,
 *     'rel' => 'nofollow',
 *     'isNofollow' => true,
 *     'isUGC' => false,
 *     'isNoopener' => false,
 *     'isNoreferrer' => false,
 * ]
 */
```

Si necesita más datos, tendrá que ampliar la biblioteca o presentar una edición para su consideración.


## Enlaces internos y externos

PHPScraper permite devolver sólo enlaces internos o externos. Lo siguiente demuestra ambas cosas:

```php
$web = new \spekulatius\phpscraper;

// Navega a la página de prueba.
$web->go('https://test-pages.phpscraper.de/links/base-href.html');

// Obtener la lista de enlaces internos (en el ejemplo se enlaza una imagen)
var_dump($web->internalLinks);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg'
 * ]
 */

// Obtener la lista de enlaces externos
var_dump($web->externalLinks);
/**
 * [
 *     'https://placekitten.com/408/287'
 * ]
 */
```
