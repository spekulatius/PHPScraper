---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Header%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Raspado de etiquetas de cabecera

Las etiquetas de cabecera suelen contener información útil sobre una página web y cómo encaja en la estructura general del sitio web del que forma parte. Los siguientes ejemplos muestran cómo acceder a determinadas piezas de información de la etiqueta `<head>` y a colecciones en torno a ellas.


## Charset

Para acceder al conjunto de caracteres definido, puede utilizar el siguiente método:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <meta charset="utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Imprimir el charset
echo $web->charset;     // "utf-8"
```


## Viewport

En algunos casos, como el viewport y las meta keywords, la cadena representa un array y se proporcionará como tal:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de la prueba. Contiene:
 *
 * <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Obtenga la ventana gráfica como una matriz. Debe contener:
 *
 * [
 *     'width=device-width',
 *     'initial-scale=1',
 *     'shrink-to-fit=no',
 *     'maximum-scale=1',
 *     'user-scalable=no'
 * ],
 */
var_dump($web->viewport);
```

Si necesitas acceder a la cadena original "viewport", puedes utilizar `viewportString`:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Obtiene el viewport como una cadena. Imprime:
 *
 * "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"
 */
echo $web->viewportString;
```


## URL canónica

La URL canónica, si se da, se puede acceder como se muestra en el siguiente ejemplo:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
 */
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Imprimir la URL canónica
echo $web->canonical;       // "https://test-pages.phpscraper.de/navigation/2.html"
```

::: tip CONSEJO
Si no se establece un enlace canónico, el método devuelve `null`.
:::


## Content-Type

Para acceder al tipo de contenido puede utilizar la siguiente funcionalidad:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Imprimir el tipo de contenido
echo $web->contentType;     // "text/html; charset=utf-8"
```


## CSFR Token

El método del token CSFR asume que el token se almacena en una etiqueta meta con el nombre "csrf-token". Este es el valor por defecto de Laravel. Puedes acceder a él usando el siguiente código:

```php
$web = new \spekulatius\phpscraper;

/**
 * Navegue hasta la página de pruebas. Contiene:
 *
 * <meta name="csrf-token" content="token" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Obtener el csrfToken
echo $web->csrfToken;     // "token"
```


## Etiquetas de cabecera combinadas

Si desea acceder a todos los métodos mencionados anteriormente, utilice el método `headers`. Se define como:

```php
/**
 * @return array
 */
public function headers()
{
    return [
        'charset' => $this->charset(),
        'contentType' => $this->contentType(),
        'viewport' => $this->viewport(),
        'canonical' => $this->canonical(),
        'csrfToken' => $this->csrfToken(),
    ];
}
```

Más información sobre el acceso a las [metaetiquetas](/es/examples/scrape-meta-tags.html).
