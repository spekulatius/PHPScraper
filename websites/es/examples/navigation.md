---
image: https://api.imageee.com/bold?text=PHP:%20Navigate%20while%20Scraping&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Navegación

Aunque PHPScraper está pensado principalmente para analizar sitios web y recopilar información, también se puede utilizar para navegar por sitios web. A continuación hay ejemplos de formas de *navegar* por un sitio web.


## Navegación usando URLs

Puedes navegar a cualquier URL. Estas URLs suelen proceder de los [enlaces analizados](/es/examples/scrape-links.html).

```php
$web = new \spekulatius\phpscraper;

// Comenzamos en la página de prueba #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Imprime el título para ver si estamos en la página correcta...
echo $web->h1[0];   // 'Page #1'


// Navegamos a la página de prueba #2 usando la URL absoluta.
$web->clickLink('https://test-pages.phpscraper.de/navigation/2.html');

// Imprime el título para ver si estamos en la página correcta...
echo $web->h1[0];   // 'Page #2'
```


## Navegación con textos de anclaje

En un sitio web se puede *hacer clic* en los enlaces utilizando sus textos de anclaje:

```php
$web = new \spekulatius\phpscraper;

// Comenzamos en la página de prueba #1.
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

/**
 * Esta página contiene:
 *
 * <a href="2.html">2 relative</a>
 */

// Imprime el título para ver si estamos en la página correcta...
echo $web->h1[0];   // 'Page #1'


// Navegamos a la página de prueba #2 usando el texto que tiene en la página.
$web->clickLink('2 relativo');

// Imprime el título para ver si estamos en la página correcta...
echo $web->h1[0];   // 'Page #2'
```

Esta funcionalidad básica debería permitirle navegar por los sitios web.
