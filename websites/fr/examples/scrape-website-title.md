---
image: https://api.imageee.com/bold?text=PHP:%20Scrape%20Website%20Title&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraper le titre d'un site web

Extraire le titre d'un site Web est simple. Les exemples suivants montrent comment cela fonctionne en utilisant PHPScraper.


## Exemple simple

Exemple très simple de la façon de récupérer le titre d'un site web:

```php
$web = new \spekulatius\phpscraper;

// Naviguer vers la page de test - celle-ci contient une étiquette de titre "Lorem Ipsum".
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Contient:
 *
 * <title>Lorem Ipsum</title>
 */

// Récupérer le titre. Cela renverra: "Lorem Ipsum"
var_dump($web->title);
```


### Titre manquant

`null` sera retourné si le titre est manquant:

```php
$web = new \spekulatius\phpscraper;

// Naviguez vers la page de test - celle-ci ne contient pas de balise titre.
$web->go('https://test-pages.phpscraper.de/meta/missing.html');

// Récupérer le titre. Ceci retournera null.
var_dump($web->title);
```

Note: C'est le comportement par défaut: Si une balise n'a pas été trouvée parce qu'elle est manquante dans le HTML source, `null` sera retourné. Si un élément itérable est vide (par exemple, pour récupérer des images d'une page sans images), un tableau vide sera retourné.


## Caractères spéciaux

Chargement d'un titre de site web avec Umlaute allemand

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <title>A page with plenty of German umlaute everywhere (ä ü ö)</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

// Imprimer le titre: "A page with plenty of German umlaute everywhere (ä ü ö)"
echo $web->title;
```

Cela devrait fonctionner de manière similaire avec tous les caractères UTF-8.


## Entités HTML

Les entités HTML doivent être résolues

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguer vers la page de test. Contient:
 *
 * <title>Cat &amp; Mouse</title>
 */
$web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

// Imprimer le titre: "Cat & Mouse"
echo $web->title;
```

::: tip conseil
Les entités et les caractères spéciaux ont été pris en compte dans toute la bibliothèque. Si vous trouvez un endroit où ils ne fonctionnent pas comme prévu, veuillez signaler le problème à l'administrateur. [numéro](https://github.com/spekulatius/PHPScraper/issues).
:::
