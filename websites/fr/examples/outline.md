---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Content%20Outline&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Outline Extraction

Bien que vous puissiez vouloir accéder uniquement à la [`rubriques`](/fr/examples/headings.html) pour traiter, par exemple, le nombre ou la longueur des titres, ce n'est pas toujours suffisant. Dans certains cas, vous pouvez avoir besoin d'identifier la structure réelle du contenu. Pour ces cas d'utilisation, vous pouvez envisager l'une de ces méthodes:

 - `outline` fonctionne de manière similaire à la méthode `headings` mentionnée précédemment. Elle retourne également tous les titres, mais elle garde la structure du document original en place et fournit les niveaux de titres (par exemple `h1`) seuls avec la sortie.

 - `outlineWithParagraphs` fonctionne de la même manière que `outline`, la différence est que cet appel inclut également les paragraphes.

 - `cleanOutlineWithParagraphs` fonctionne de la même manière que `outlineWithParagraphs`, à la différence que toutes les balises HTML vides sont supprimées.

Les exemples suivants devraient vous aider à mieux comprendre cette fonctionnalité. Il existe des méthodes dédiées pour [extraction de mots-clés](/fr/examples/extract-keywords.html) disponible sur.


## Extraire l'Outline

L'Outline Extraction vous permet de construire un index du document. L'exemple suivant construit une version markdown des titres du document demandé:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguer vers la page de test. Cette page contient:
 *
 * <h1>We are testing here!</h1>
 * [...]
 *
 * <h2>Examples</h2>
 * [...]
 *
 * <h3>Example 1</h3>
 * [...]
 *
 * <h3>Example 2</h3>
 * [...]
 *
 * <h3>Example 3</h3>
 * [...]
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');

/**
 * $outline sera défini comme contenant:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ]
 * ]
 */
$outline = $web->outline;
```


### Extraire le plan avec des paragraphes

La méthode suivante fonctionne de manière similaire à `outline`, mais elle inclut également les paragraphes dans le tableau retourné:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->outlineWithParagraphs;
/**
 * $content now contains:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ], [
 *      "tag" => "p",
 *      "content" => ""
 *    ]
 * ]
 */
```


## Extraire le plan nettoyé avec les paragraphes.

La méthode suivante fonctionne de manière similaire à `outlineWithParagraphs`, mais elle n'inclut aucun titre ou paragraphe vide dans le tableau retourné:

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
 *
 * <!-- an empty paragraph to check if it gets filtered out correctly -->
 * <p></p>
 */
$web->go('https://test-pages.phpscraper.de/content/outline.html');


$content = $web->cleanOutlineWithParagraphs;
/**
 * $content contient maintenant:
 *
 * [
 *    [
 *      "tag" => "h1",
 *      "content" =>  "We are testing here!"
 *    ], [
 *      "tag" => "p",
 *      "content" => "This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example."
 *    ], [
 *      "tag" => "h2",
 *      "content" => "Examples"
 *    ], [
 *      "tag" => "p",
 *      "content" => "There are numerous examples on the website. Please check them out to get more context on how scraping works."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 1"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be an example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 2"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be the second example."
 *    ], [
 *      "tag" => "h3",
 *      "content" => "Example 3"
 *    ], [
 *      "tag" => "p",
 *      "content" => "Here would be another example."
 *    ]
 * ]
 */
```
