---
image: https://api.imageee.com/bold?text=PHP:%20Extract%20Keywords&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Mots clés extraits

Bien que le scraping du contenu soit souvent suffisant, vous avez parfois besoin d'extraire des termes et des phrases spécifiques (mots-clés) dans ce contenu. PHPScraper vous permet d'extraire directement les mots-clés du site web. Pour cela, il utilise:

- le titre du site web,
- les balises méta,
- tous les titres,
- les paragraphes de la page,
- les ancres et les titres des liens, ainsi que
- les attributs de titre des images

Si ces mots-clés sont extraits, cela ne signifie pas que la page est effectivement classée pour ces mots-clés. C'est le moteur de recherche qui prend la décision finale quant au classement d'une page Web.

L'exemple suivant renvoie une liste de tous les mots-clés extraits de la page Web:

```php
$web = new \spekulatius\phpscraper;

// Naviguer vers la page de test.
// Elle contient 3 paragraphes de l'article de Wikipédia en anglais pour "lorem ipsum".
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Vérifier le nombre de mots-clés.
$keywords = $web->contentKeywords;
echo "Cette page contient au moins " . count($keywords) . " mots-clés/phrases.\n\n";

// Boucle à travers les mots-clés
foreach ($keywords as $keyword) {
    echo " - " . $keyword . "\n";
}

/**
 * S'imprimera:
 *
 * Cette page contient au moins 40 mots-clés/expressions.
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

::: tip Conseil
La langue (locale) par défaut est `en_US`. D'autres langues peuvent être passées en paramètre. Actuellement, cela ne fonctionne que pour une sélection de langues. Vérifiez ceci [liste](https://github.com/Donatello-za/rake-php-plus#currently-supported-languages) pour de plus amples informations.
:::


## Notation des mots-clés

Tous les mots clés n'ont pas le même poids dans les algorithmes de classement des moteurs de recherche. Un mélange de plusieurs facteurs et signaux de référencement décide du poids qu'un moteur de recherche attribue à un mot. La fréquence des mots, la longueur des textes et les variations telles que les synonymes peuvent entraîner une pondération différente.

PHPScraper vous permet d'obtenir une indication de la pondération des mots-clés sous la forme de scores:

```php
$web = new \spekulatius\phpscraper;

// Naviguer vers la page de test.
// Il contient 3 paragraphes de l'article de Wikipédia en anglais pour "lorem ipsum".
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Vérifier le nombre de mots-clés.
$keywords = $web->contentKeywordsWithScores;
echo "Cette page contient au moins " . count($keywords) . " mots-clés/phrases.\n\n";

// Boucle à travers les mots-clés
foreach ($keywords as $keyword => $score) {
    echo sprintf(" - %s (%s)\n", $keyword, $score);
}

/**
 * S'affichera:
 *
 * Cette page contient au moins 40 mots-clés/expressions.
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

::: tip Conseil
Les fonctions PHP [similar_text](https://www.php.net/manual/en/function.similar-text.php) et [levenshtein](https://www.php.net/manual/en/function.levenshtein.php) peut vous aider à identifier et à fusionner les mots-clés similaires ainsi que les variations typographiques des mots-clés. [Keyword Merge](https://github.com/spekulatius/keyword-merge) est un paquet de compositeurs pour aider à trier les mots-clés similaires.
:::
