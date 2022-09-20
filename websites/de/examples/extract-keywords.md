---
image: https://api.imageee.com/bold?text=PHP:%20Extract%20Keywords&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Keywords Extrahieren

Während es oft ausreicht, Inhalte zu scrapen, müssen Sie manchmal wichtige Begriffe und Phrasen (Keywords) aus diesen Inhalten extrahieren. PHPScraper ermöglicht es Ihnen, die Keywords der Website direkt zu extrahieren. Hierfür verwendet er:

- den Titel der Website,
- die Meta-Tags,
- alle Überschriften,
- die Absätze auf der Seite,
- Link-Anker und Link-Titel sowie
- Titelattribute bei Bildern

Auch wenn diese Schlüsselwörter extrahiert werden, bedeutet dies nicht, dass die Seite tatsächlich für diese Schlüsselwörter rangiert. Die endgültige Entscheidung darüber, für welche Schlüsselwörter eine Webseite rangiert, liegt bei der Suchmaschine.

Das folgende Beispiel gibt eine Liste aller aus der Webseite extrahierten Keywords zurück:

```php
$web = new \spekulatius\phpscraper;

// Navigation zur Testseite.
// Diese enthält 3 Absätze aus dem englischen Wikipedia-Artikel zu "lorem ipsum".
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Überprüfen der Anzahl der Schlüsselwörter.
$keywords = $web->contentKeywords;
echo "Diese Seite enthält mindestens" . count($keywords) . " Schlüsselwörter/Phrasen.\n\n";

// Schleife durch die Schlüsselwörter
foreach ($keywords as $keyword) {
    echo " - " . $keyword . "\n";
}

/**
 * Ausgegeben wird:
 *
 * Diese Seite enthält mindestens 40 Schlüsselwörter/Phrasen.
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

::: tip Tipp
Die Standardsprache (Gebietsschema) hierfür ist "en_US". Andere Sprachen, wie Deutsch, können als Parameter übergeben werden. Dies funktioniert derzeit nur für eine Auswahl von Sprachen. Weitere Informationen finden Sie in dieser [list](https://github.com/Donatello-za/rake-php-plus#currently-supported-languages).
:::


## Bewertung von Schlüsselwörtern

Nicht jedes Keyword hat in den Ranking-Algorithmen der Suchmaschinen das gleiche Gewicht. Ein Mix aus verschiedenen Faktoren und SEO-Signalen entscheidet über die Gewichtung, die eine Suchmaschine einem Wort zuweist. Häufigkeit der Wörter, Länge der Texte und Variationen wie Synonyme können zu einer unterschiedlichen Gewichtung führen.

PHPScraper ermöglicht es Ihnen, einen Hinweis auf die Gewichtung der Keywords in Form von Scores zu erhalten:

```php
$web = new \spekulatius\phpscraper;

// Navigation zur Testseite.
// Diese enthält 3 Absätze aus dem englischen Wikipedia-Artikel zu "lorem ipsum".
$web->go('https://test-pages.phpscraper.de/content/keywords.html');

// Überprüfen der Anzahl der Schlüsselwörter.
$keywords = $web->contentKeywordsWithScores;
echo "Diese Seite enthält mindestens " . count($keywords) . " Schlüsselwörter/Phrasen.\n\n";

// Schleife durch die Schlüsselwörter
foreach ($keywords as $keyword => $score) {
    echo sprintf(" - %s (%s)\n", $keyword, $score);
}

/**
 * Ausgegeben wird:
 *
 * Diese Seite enthält mindestens 40 Schlüsselwörter/Phrasen.
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

::: tip Tipp
Die PHP-Funktionen [similar_text](https://www.php.net/manual/en/function.similar-text.php) und [levenshtein](https://www.php.net/manual/en/function.levenshtein.php) können Ihnen helfen, ähnliche Schlüsselwörter sowie Tippfehler-Varianten von Schlüsselwörtern zu identifizieren und zusammenzuführen. [Keyword Merge](https://github.com/spekulatius/keyword-merge) ist ein Composer-Paket, das beim Aussortieren ähnlicher Schlüsselwörter hilft.
:::
