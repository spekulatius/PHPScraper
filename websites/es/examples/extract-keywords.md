---
image: https://api.imageee.com/bold?text=PHP:%20Extract%20Keywords&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Extraer palabras clave

Mientras que raspar el contenido es a menudo suficiente, a veces se requiere extraer términos y frases significativas (palabras clave) de este contenido. PHPScraper le permite extraer las palabras clave del sitio web directamente. Para ello utiliza:

- el título del sitio web,
- los meta tags,
- todos los encabezados,
- los párrafos de la página,
- los anclajes y los títulos de los enlaces, así como
- los atributos del título de las imágenes

Aunque se extraigan estas frases de palabras clave, no significa que la página se clasifique realmente para estas palabras clave. La decisión final sobre qué palabras clave clasifica una página web corresponde al motor de búsqueda.

El siguiente ejemplo devolverá una lista de todas las palabras clave extraídas de la página web:

```php
$web = new \spekulatius\phpscraper;

// Navega a la página de prueba.
// Contiene 3 párrafos del artículo de Wikipedia en inglés para "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Comprobar el número de palabras clave.
$keywords = $web->contentKeywords;
echo "Esta página contiene al menos " . count($keywords) . " palabras clave/frases.\n\n";

// Recorrer en bucle las palabras clave
foreach ($keywords as $keyword) {
    echo " - " . $keyword . "\n";
}

/**
 * Se imprimirá:
 *
 * Esta página contiene al menos 40 palabras clave/frases.
 *
 * [...]
 * - graphic
 * - improper latin
 * - introduced
 * - keyword extraction tests
 * - letraset transfer sheets
 * - lorem ipsum
 * - lorem ipsum    php rake library  lorem ipsum
 * - lorem ipsum text
 * - make
 * - malorum
 * - microsoft word
 * - mid-1980s
 * - nonsensical
 * - page
 * - paragraphs
 * - philosopher cicero
 * - php rake library
 * - popular word processors including pages
 * - popularized
 * - removed
 * - roman statesman
 * - source
 * [...]
 */
```

::: tip CONSEJO
El idioma por defecto (locale) es `en_US`. Se pueden pasar otros idiomas como parámetro. Actualmente sólo funciona para una selección de idiomas. Consulte esta [lista](https://github.com/Donatello-za/rake-php-plus#currently-supported-languages) para obtener más información.
:::


## Puntuación de las palabras clave

No todas las palabras clave tienen el mismo peso en los algoritmos de clasificación de los motores de búsqueda. Una mezcla de varios factores y señales de SEO decide el peso que un motor de búsqueda asigna a una palabra. La frecuencia de las palabras, la longitud de los textos y las variaciones, como los sinónimos, pueden dar lugar a una ponderación diferente.

PHPScraper le permite obtener una indicación del peso de las palabras clave en forma de puntuación:


```php
$web = new \spekulatius\phpscraper;

// Navega a la página de prueba.
// Contiene 3 párrafos del artículo de Wikipedia en inglés para "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Comprobar el número de palabras clave.
$keywords = $web->contentKeywordsWithScores;
echo "Esta página contiene al menos " . count($keywords) . " palabras clave/frases.\n\n";

// Recorrer en bucle las palabras clave
foreach ($keywords as $keyword => $score) {
    echo sprintf(" - %s (%s)\n", $keyword, $score);
}

/**
 * Se imprimirá:
 *
 * Esta página contiene al menos 40 palabras clave/frases.
 *
 * [...]
 *  - 1960s (1.0)
 *  - added (1.0)
 *  - adopted lorem ipsum (11.0)
 *  - advertisements (1.0)
 *  - aldus employed (4.0)
 *  - corrupted version (4.0)
 *  - graphic (1.0)
 *  - improper latin (4.0)
 *  - introduced (1.0)
 *  - keyword extraction tests (9.0)
 *  - test (1.0)
 *  - microsoft word (5.3333333333333)
 *  - english wikipedia (4.0)
 *  - lorem ipsum (8.0)
 *  - lorem ipsum text (11.0)
 * [...]
 */
```

::: tip CONSEJO
Las funciones PHP [similar_text](https://www.php.net/manual/en/function.similar-text.php) y [levenshtein](https://www.php.net/manual/en/function.levenshtein.php) pueden ayudarle a identificar y fusionar palabras clave similares, así como variaciones tipográficas de palabras clave. [Keyword Merge](https://github.com/spekulatius/keyword-merge) es un paquete de compositor que ayuda a clasificar palabras clave similares.
:::
