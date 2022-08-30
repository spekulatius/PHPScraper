---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Headings&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Headings

Les titres peuvent être utiles pour se faire une idée du contenu d'un site Web. L'exemple suivant montre comment effectuer un scraping:

 - Un seul Heading
 - Tous les titres d'un niveau particulier (par exemple, `<h3>`)
 - Tous les titres d'une page


## Récupération d'un seul titre

La récupération d'un seul titre est facile et peut être réalisée en suivant cet exemple:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <title>Outline Test</title>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

// Imprimer l'en-tête H1
echo $web->h1[0];          // "Outline Test"
```

::: tip Conseil
Le site [titre du site web](/fr/examples/scrape-website-title.html) et la rubrique 1 (`<h1>`) peuvent être différentes. Assurez-vous que vous récupérez le bon.
:::


## Rubriques par niveau

Il peut arriver que vous souhaitiez récupérer toutes les rubriques d'un niveau particulier. L'exemple ci-dessous vous montre comment faire:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * Obtenir les en-têtes h3:
 *
 * [
 *    'Example 1',
 *    'Example 2',
 *    'Example 3'
 * ]
 */
$web->h3;
```

Si aucun titre n'est trouvé, le tableau est laissé vide.


## Toutes les rubriques d'une page

Pour accéder à toutes les rubriques d'une page, vous pouvez le faire en accédant aux différents niveaux de 1 à 6. Ou bien, vous pouvez accéder à toutes les rubriques en même temps:


```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguer vers la page de test. Cette page contient:
 *
 * <h1>We are testing here!</h1>
 * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
 *
 * <h2>Examples</h2>
 * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
 *
 * <h3>Example 1</h3>
 * <p>Here would be an example.</p>
 *
 * <h3>Example 2</h3>
 * <p>Here would be the second example.</p>
 *
 * <h3>Example 3</h3>
 * <p>Here would be another example.</p>
 */
$web->go('https://test-pages.phpscraper.de/content/online.html');

/**
 * $headings contains now:
 *
 * [
 *     [
 *         'We are testing here!'
 *     ],
 *     [
 *         'Examples'
 *     ],
 *     [
 *         'Example 1',
 *         'Example 2',
 *         'Example 3',
 *     ],
 *     [],
 *     [],
 *     []
 * ]
 */
$web->headings;
```

Comme vous pouvez le constater, il ne contient aucune information sur la structure des rubriques. Il s'agit uniquement de savoir quelles rubriques existent. Si vous souhaitez avoir une [aperçu](/fr/examples/outline.html) vous devrez utiliser les méthodes correspondantes.
