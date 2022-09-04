---
image: https://api.imageee.com/bold?text=PHPScraper:%20an%20highly%20opinionated%20web-interface&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

PHP Scraper: Rendre sa simplicité au Scraping et au Crawling
============================================================

![PHP Scraper: Rendre sa simplicité au Scraping et au Crawling](logo-light.png)

*de [Peter Thaleikis](https://peterthaleikis.com)*

PHPScraper est une bibliothèque de scraper pour PHP, construite avec la notion de simplicité en tête. Il s'agit d'un wrapper fait à partir de quelques grandes bibliothèques PHP pour rendre l'accès au web plus facile.

Les exemples valent mieux que mille mots. Jetez-y un coup d'œil !

::: tip Note
Ce site de documentation en français est en cours d'élaboration. Veuillez élever un PR sur GitHub si vous trouvez des erreurs. Merci !
:::


L'idée 💡️
----------

Accéder aux sites web et collecter les informations de base du web est trop complexe. Cette enveloppe autour de [Goutte](https://github.com/FriendsOfPHP/Goutte) rend les choses plus faciles. Il vous épargne XPath et autres, en vous donnant un accès direct à tout ce dont vous avez besoin. Le scraping Web avec PHP: un nouveau concept.


Supporters 💪️
-------------

Ce projet est sponsorisé par:

<a href="https://bringyourownideas.com" target="_blank" rel="noopener noreferrer"><img src="https://bringyourownideas.com/images/byoi-logo.jpg" height="100px"></a>

Vous souhaitez devenir sponsor de ce projet? [Écrivez-moi](https://peterthaleikis.com/contact).


Exemples
--------

Voici quelques exemples de ce que la bibliothèque de scraping web peut faire à ce stade:

### Scrape Meta Information:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta name="author" content="Lorem ipsum" />
 * <meta name="keywords" content="Lorem,ipsum,dolor" />
 * <meta name="description" content="Lorem ipsum dolor etc." />
 * <meta name="image" content="https://test-pages.phpscraper.de/assets/cat.jpg" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Obtenir l'information:
echo $web->author;          // "Lorem ipsum"
echo $web->description;     // "Lorem ipsum dolor etc."
echo $web->image;           // "https://test-pages.phpscraper.de/assets/cat.jpg"
```

La plupart des autres informations sont accessibles directement, sous forme de chaîne ou de tableau..


### Racler du contenu, comme des images:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Cette page contient deux images:
 *
 * <img src="https://test-pages.phpscraper.de/assets/cat.jpg" alt="absolute path">
 * <img src="/assets/cat.jpg" alt="relative path">
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

var_dump($web->imagesWithDetails);
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
```

Certaines informations *optionnellement* sont retournées comme un tableau avec des détails. Pour cet exemple, une simple liste d'images est disponible en utilisant `$web->images` aussi. Cela devrait faciliter votre travail de scraping web.

Vous trouverez plus d'exemples de code dans les exemples individuels et dans les tests.


Installation
------------

L'installation se fait généralement en utilisant [Composer](https://getcomposer.org).

### Installation avec Composer

```bash
composer require spekulatius/phpscraper
```

Une fois l'installation terminée, le paquet sera récupéré par l'autoloader de Composer. Dans les applications et frameworks PHP typiques tels que Laravel ou Symfony, vous pouvez commencer à faire du scraping maintenant. Vous pouvez maintenant utiliser n'importe lequel des exemples mentionnés ou des exemples dans le dossier `tests/`.

### Utilisation dans les projets VanillaPHP

Si vous construisez un projet VanillaPHP, vous devrez inclure l'autoloader dans votre script au début de votre script PHP:

```php
require 'vendor/autoload.php';
```

Si vous utilisez un framework tel que Laravel, Symfony, Zend, Phalcon ou CakePHP, vous n'aurez pas besoin de cette étape. L'autoloader est automatiquement inclus.


Vous avez trouvé un bug et l'avez corrigé ? C'est génial !
----------------------------------

Avant de commencer, familiarisez-vous avec les éléments suivants [directives de contribution](/contributing.html). Si vous avez des questions, n'hésitez pas à nous contacter.


Tests: S'assurer que ça marche !
----------------------------

Le code est grossièrement couvert par des tests de bout en bout. Pour cela, des pages web simples sont hébergées sur *https://test-pages.phpscraper.de/*, chargées et analysées à l'aide de [PHPUnit](https://phpunit.de/). Ces tests peuvent également servir d'exemples - voir `tests/` !

Ceci étant dit, il y a probablement des edge cases qui ne fonctionnent pas et qui peuvent causer des problèmes. Si vous en trouvez un, veuillez signaler un bug sur GitHub.

Dédicaces
----------------------------
Remerciements à mon ami [@yesnoornext](https://twitter.com/yesnoornext) pour son aide précieuse sur ce projet.
