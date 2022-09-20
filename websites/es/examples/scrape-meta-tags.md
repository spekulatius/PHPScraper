---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Meta%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Meta Tags

El acceso a la información meta sigue un patrón similar al mostrado anteriormente [etiquetas de cabecera](/es/examples/scrape-header-tags.html). A continuación se muestran algunos ejemplos:


## Meta Autor, Descripción e Imagen

El siguiente ejemplo muestra la extracción de tres atributos:

- el Meta Autor,
- la Meta Descripción y
- la URL de la meta imagen

```php
$web = new \spekulatius\phpscraper;

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


## Meta Keywords

La meta etiqueta de palabras clave es naturalmente una matriz y será dividida para su conveniencia:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <meta name="keywords" content="one, two, three">
 */
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Volcar las palabras clave como un array
var_dump($web->keywords);   // ['one', 'two', 'three']
```

También puede acceder a la cadena de palabras clave original:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Imprime las palabras clave en forma de cadena
echo $web->keywordString;   // "one, two, three"
```

::: tip CONSEJO
Esto se refiere únicamente a las palabras clave de la metaetiqueta "keyword". También puede [extraer las palabras clave del contenido](/es/examples/extract-keywords.html)) utilizando PHPScraper.
:::


## Meta Etiquetas Combinadas

Si desea acceder a todas las meta propiedades puede utilizar el método `metaTags`. Devuelve los métodos mencionados anteriormente como un array. Se define como:

```php
/**
 * obtener la meta recogida como un array
 *
 * @return array
 */
public function metaTags()
{
    return [
        'author' => $this->author(),
        'image' => $this->image(),
        'keywords' => $this->keywords(),
        'description' => $this->description(),
    ];
}
```

A partir del ejemplo anterior se utilizaría lo siguiente:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

var_dump($web->metaTags);
/**
 * Contiene:
 *
 * [
 *     'Lorem ipsum',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     ['one', 'two', 'three'],
 *     'Lorem ipsum dolor etc.',
 * ]
 */
```


## Falta de metaetiquetas

Si necesita acceder a otra metapropiedad puede considerar [contribuir](/contributing.html) al paquete o enviando un [issue en GitHub](https://github.com/spekulatius/phpscraper/issues).
