---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Images&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping d'images

Récupérer les images &amp; Les photos d'un site Web suivent une approche similaire à celle des autres exemples. Tous les graphiques tels que les images, les photos et les infographies peuvent être analysés avec des détails tels que les attributs de balises ou uniquement sous forme de liste d'URL.


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
Le texte `alt` (avec le caractère [mots-clés du contenu](/fr/examples/extract-keywords)) est utilisé par les moteurs de recherche pour les recherches basées sur les images. Veillez à toujours le définir.
:::


## Attributs du scraping: Alt, largeur et hauteur

Les attributs pour `alt`, `width` et `height` sont inclus dans l'ensemble de données détaillées.

Si vous avez besoin de plus de données, vous devrez soit étendre la bibliothèque, soit soumettre un problème pour examen.
