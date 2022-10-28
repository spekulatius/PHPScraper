---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Links&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Links

Le scraping de liens fonctionne de manière très similaire ay [scraping d'images](/fr/examples/scrape-images.html). Vous pouvez récupérer une liste d'URL sans aucune information supplémentaire ainsi qu'une liste détaillée contenant `rel`, `target` ainsi que d'autres attributs.


## Liste de liens simples

L'exemple suivant analyse une page Web à la recherche de liens et renvoie un tableau d'URL absolues:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient 6 liens vers placekitten.com avec des attributs différents:
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

// Imprimer le nombre de liens.
echo "Cette page contient " . count($web->links) . " liens.\n\n";

// Boucle à travers les liens
foreach ($web->links as $link) {
    echo " - " . $link . "\n";
}

/**
 * Combiné, cela s'imprimera:
 *
 * Cette page contient 6 liens.
 *
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 * - https://placekitten.com/408/287
 * - https://placekitten.com/444/333
 * - https://placekitten.com/444/321
 */
```

Si la page ne doit pas contenir de liens, un tableau vide est renvoyé.


## Liens avec les détails

Si vous avez besoin de plus de détails, vous pouvez y accéder de la même manière que pour les images. Voici un exemple pour accéder aux données détaillées du premier lien de la page:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Cette page contient un certain nombre de liens avec des attributs rel différents. Pour gagner de la place, ne retenez que le premier:
 *
 * <a href="https://placekitten.com/432/287" rel="nofollow">external kitten</a>
 */
$web->go('https://test-pages.phpscraper.de/links/rel.html');

// Obtenez le premier lien de la page.
$firstLink = $web->linksWithDetails[0];

/**
 * $firstLink contient maintenant:
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

Si vous avez besoin de plus de données, vous devrez soit étendre la bibliothèque, soit soumettre une question pour examen.


## Liens internes et liens externes

PHPScraper permet de retourner seulement des liens internes ou externes. L'exemple suivant démontre les deux:

```php
$web = new \spekulatius\phpscraper;

// Naviguer vers la page de test.
$web->go('https://test-pages.phpscraper.de/links/base-href.html');

// Obtenez la liste des liens internes (dans l'exemple, une image est liée).
var_dump($web->internalLinks);
/**
 * [
 *     'https://test-pages.phpscraper.de/assets/cat.jpg'
 * ]
 */

// Obtenir la liste des liens externes
var_dump($web->externalLinks);
/**
 * [
 *     'https://placekitten.com/408/287'
 * ]
 */
```
