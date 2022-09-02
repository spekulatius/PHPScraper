---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping d'images

Vous vous demandez peut-être comment scraper des photos, des images et d'autres graphiques d'un site Web à l'aide de PHPScraper. Comme pour les autres fonctionnalités, le scraping des images &amp; photos d'un site web suit une approche similaire. Tous les graphiques tels que les images, les photos et les infographies peuvent être scrapés et analysés avec des détails tels que les attributs des balises ou seulement comme une liste d'URL.


## Scraping Image URLs

L'exemple suivant analyse une page Web à la recherche d'images et renvoie les URL absolues des images sous forme de tableau.

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Cette page contient deux images:
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
 * @Note:
 * Double car il s'agit de deux fois la même image:
 * Une fois avec un chemin relatif et une fois avec un chemin absolu.
 * Les chemins relatifs sont résolus en chemins absolus par défaut.
 */
var_dump($web->images);
```

::: tip Conseil
Si aucune image n'est trouvée, le tableau reste vide.
:::


## Scraping d'images avec des détails

Si vous avez besoin de plus de détails, les requêtes suivantes vous permettent d'accéder aux attributs de la balise image:

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
Le texte `alt` (avec le caractère [mots-clés du contenu](/fr/examples/extract-keywords.html)) est utilisé par les moteurs de recherche pour les recherches basées sur les images. Veillez à toujours le définir.
:::


## Attributs du scraping: Alt, largeur et hauteur

Les attributs pour `alt`, `width` et `height` sont inclus dans l'ensemble de données détaillées.

Si vous avez besoin de plus de données, vous devrez soit étendre la bibliothèque, soit soumettre un problème pour examen.
