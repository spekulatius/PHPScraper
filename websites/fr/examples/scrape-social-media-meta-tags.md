---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Social%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Social Media Meta Tags

L'extraction des balises de partage des médias sociaux d'un site Web peut être effectuée à l'aide des méthodes suivantes. L'ensemble des résultats exacts dépend des balises fournies. Toutes les balises sont incluses, tant qu'elles sont dans l'espace de nom préfixé (par exemple `twitter:` pour les cartes Twitter).


## Données Open-Graph (OG)

Il est possible de récupérer les données des graphiques ouverts:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguer vers la page de test. La page contient:
 *
 * <!-- open graph example -->
 * <meta property="og:site_name" content="Lorem ipsum" />
 * <meta property="og:type" content="website" />
 * <meta property="og:title" content="Lorem Ipsum" />
 * <meta property="og:description" content="Lorem ipsum dolor etc." />
 * <meta property="og:url" content="https://test-pages.phpscraper.de/meta/lorem-ipsum.html" />
 * <meta property="og:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/og/example.html
 */
$web->go('https://test-pages.phpscraper.de/og/example.html');

// Doit imprimer 'Lorem Ipsum'.
echo $web->openGraph['og:title'];

// Doit imprimer "Lorem ipsum dolor etc.".
echo $web->openGraph['og:description'];

// L'ensemble du jeu:
$data = $web->openGraph;

/**
 * $data contient maintenant:
 *
 * [
 *     'og:site_name' => 'Lorem ipsum',
 *     'og:type' => 'website',
 *     'og:title' => 'Lorem Ipsum',
 *     'og:description' => 'Lorem ipsum dolor etc.',
 *     'og:url' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
 *     'og:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

::: tip conseil
Si aucune donnée n'a été trouvée, le tableau sera retourné vide.
:::


## Carte Twitter

L'analyse de la carte Twitter fonctionne de la même manière:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. La page contient la carte Twitter suivante:
 *
 * <!-- Twitter card -->
 * <meta name="twitter:card" content="summary_large_image" />
 * <meta name="twitter:title" content="Lorem Ipsum" />
 * <meta name="twitter:description" content="Lorem ipsum dolor etc." />
 * <meta name="twitter:url" content="https://test-pages.phpscraper.de/meta/lorem-ipsum.html" />
 * <meta name="twitter:image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 *
 * @see https://test-pages.phpscraper.de/twittercard/example.html
 */
$web->go('https://test-pages.phpscraper.de/twittercard/example.html');

// Devrait imprimer 'summary_large_image'.
echo $web->twitterCard['twitter:card'];

// Doit imprimer 'Lorem Ipsum'.
echo $web->twitterCard['twitter:title'];

// L'ensemble du jeu.
$data = $web->twitterCard;

/**
 * $data contient maintenant:
 *
 * [
 *     'twitter:card' => 'summary_large_image',
 *     'twitter:title' => 'Lorem Ipsum',
 *     'twitter:description' => 'Lorem ipsum dolor etc.',
 *     'twitter:url' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
 *     'twitter:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
 * ]
 */
```

De manière similaire à Open Graph, le tableau sera vide si aucune balise Twitter Card n'a été trouvée.
