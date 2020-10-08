---
image: https://api.imageee.com/bold?text=PHP:%20Extract%20Keywords&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Extract Keywords

While scraping content is often enough, sometimes you require to extract significant terms and phrases (keywords) from this content. PHPScraper allows you to extract the keywords of the website directly. For this it uses:

- the title of the website,
- the meta tags,
- all headings,
- the paragraphs on the page,
- link anchors and link titles as well as
- title attributes on images

While these keyword phrases are extracted it doesn't mean the page actually ranks for these keywords. The final decision on which keywords a web-page ranks is with the search engine.

The following example will return a list of all keywords extracted from the web-page:

```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
// It contains 3 paragraphs from the English Wikipedia article for "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// check the number of keywords.
$keywords = $web->contentKeywords;
echo "This page contains at least " . count($keywords) . " keywords/phrases.\n\n";

// Loop through the keywords
foreach ($keywords as $keyword) {
    echo " - " . $keyword . "\n";
}

/**
 * Will print out:
 *
 * This page contains at least 40 keywords/phrases.
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

::: tip
The default language (locale) for this is `en_US`. Other languages can be passed as a parameter. This currently works only for a selection of languages. Check this [list](https://github.com/Donatello-za/rake-php-plus#currently-supported-languages) for further information.
:::


## Scoring of Keywords

Not every keyword has the same weight in the ranking-algorithms of search engines. A mix of several factors and SEO-signals decides on the weight a search engine assigns to a word. Frequency of words, length of the texts, and variations such as synonyms can lead to different weighting.

The PHPScraper library allows you to get an indication of keyword weights in the form of scores:


```PHP
$web = new \spekulatius\phpscraper();

// Navigate to the test page.
// It contains 3 paragraphs from the English Wikipedia article for "lorem ipsum"
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// check the number of keywords.
$keywords = $web->contentKeywordsWithScores;
echo "This page contains at least " . count($keywords) . " keywords/phrases.\n\n";

// Loop through the keywords
foreach ($keywords as $keyword => $score) {
    echo sprintf(" - %s (%s)\n", $keyword, $score);
}

/**
 * Will print out:
 *
 * This page contains at least 40 keywords/phrases.
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

::: tip
The PHP-functions [similar_text](https://www.php.net/manual/en/function.similar-text.php) and [levenshtein](https://www.php.net/manual/en/function.levenshtein.php) can help you identify and merge similar keywords as well as typo variations of keywords. [Keyword Merge](https://github.com/spekulatius/keyword-merge) is a composer package to help sorting out similar keywords.
:::
