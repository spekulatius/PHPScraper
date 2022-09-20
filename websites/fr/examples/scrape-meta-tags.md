---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Meta%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scraping Meta Tags

L'accès aux méta-informations suit un schéma similaire à celui présenté précédemment. [balises d'en-tête](/fr/examples/scrape-header-tags.html). Vous trouverez ci-dessous une série d'exemples:


## Meta Author, Description et Image

L'exemple suivant montre l'extraction de trois attributs:

- l'Auteur Meta,
- la Meta Description et
- l'URL de la méta-image

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


## Mots-clés Méta

Le méta-tag "keywords" est naturellement un tableau et sera divisé pour votre convenance:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta name="keywords" content="one, two, three">
 */
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Vide les mots clés dans un tableau
var_dump($web->keywords);   // ['one', 'two', 'three']
```

Vous pouvez également accéder à la chaîne de mots-clés originale:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

// Imprimez les mots-clés sous forme de chaîne
echo $web->keywordString;   // "one, two, three"
```

::: tip conseil
Il s'agit uniquement des mots-clés figurant dans le métabaliseur "keyword". Vous pouvez également [extract the content keywords](/fr/examples/extract-keywords.html) en utilisant PHPScraper.
:::


## Balises Méta combinées

Si vous souhaitez accéder à toutes les propriétés méta, vous pouvez utiliser la méthode `metaTags`. Elle retourne les méthodes mentionnées ci-dessus sous forme de tableau. Elle est définie comme suit:

```php
/**
 * obtenir les méta collectés sous forme de tableau
 *
 * @return array
 */
public function metaTags()
{
    return [
        'author' => $this->author(),
        'image' => $this->image(),
        'keywords' => $this->keywords(),
        'description' => $this->description(),
    ];
}
```

Dans l'exemple ci-dessus, il serait utilisé comme suit:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

var_dump($web->metaTags);
/**
 * Contient:
 *
 * [
 *     'Lorem ipsum',
 *     'https://test-pages.phpscraper.de/assets/cat.jpg',
 *     ['one', 'two', 'three'],
 *     'Lorem ipsum dolor etc.',
 * ]
 */
```


## Balises Méta manquantes

Si vous avez besoin d'accéder à une autre méta-propriété, veuillez lire l'article suivant [directives de contribution](/contributing.html) avant d'ouvrir une demande de modification ou de soumettre une [problème sur GitHub](https://github.com/spekulatius/phpscraper/issues).
