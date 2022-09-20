---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Header%20Tags&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Gratter les balises d'en-tête

Les balises d'en-tête contiennent souvent des informations utiles sur une page Web et sur la façon dont elle s'intègre dans la structure globale du site dont elle fait partie. Les exemples suivants montrent comment accéder à des éléments d'information particuliers de la balise `<head>` et à des collections autour de ceux-ci.


## Charset

Pour accéder au charset défini, vous pouvez utiliser la méthode suivante:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta charset="utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Imprimez le charset
echo $web->charset;     // "utf-8"
```


## Viewport

Dans certains cas, comme pour la fenêtre d'affichage et les méta-mots-clés, la string représente un tableau et sera fournie comme telle:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Obtenez la fenêtre d'affichage sous forme de tableau. Il doit contenir:
 *
 * [
 *     'width=device-width',
 *     'initial-scale=1',
 *     'shrink-to-fit=no',
 *     'maximum-scale=1',
 *     'user-scalable=no'
 * ],
 */
var_dump($web->viewport);
```

Si vous avez besoin d'accéder à la string originale de "viewport", vous pouvez utiliser `viewportString`:

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

/**
 * Obtenir la fenêtre d'affichage sous forme de chaîne. Imprime:
 *
 * "width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no"
 */
echo $web->viewportString;
```


## URL canonique

L'URL canonique, si elle est donnée, est accessible comme indiqué dans l'exemple ci-dessous:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
 */
$web->go('https://test-pages.phpscraper.de/navigation/1.html');

// Imprimer l'URL canonique
echo $web->canonical;       // "https://test-pages.phpscraper.de/navigation/2.html"
```

::: tip Conseil
Si aucun lien canonique n'est défini, la méthode renvoie `null`.
:::


## Content-Type

Pour accéder au type de contenu, vous pouvez utiliser la fonctionnalité suivante:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Imprimez le contentType
echo $web->contentType;     // "text/html; charset=utf-8"
```


## CSFR Token

La méthode CSFR token suppose que le jeton est stocké dans une balise méta avec le nom "csrf-token". C'est la valeur par défaut pour Laravel. Vous pouvez y accéder en utilisant le code suivant:

```php
$web = new \spekulatius\phpscraper;

/**
 * Naviguez vers la page de test. Elle contient:
 *
 * <meta name="csrf-token" content="token" />
 */
$web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

// Obtenir le csrfToken
echo $web->csrfToken;     // "token"
```


## Balises d'en-tête combinées

Si vous voulez accéder à toutes les méthodes mentionnées ci-dessus, utilisez la méthode `headers`. Elle est définie comme suit:

```php
/**
 * @return array
 */
public function headers()
{
    return [
        'charset' => $this->charset(),
        'contentType' => $this->contentType(),
        'viewport' => $this->viewport(),
        'canonical' => $this->canonical(),
        'csrfToken' => $this->csrfToken(),
    ];
}
```

Plus d'informations sur l'accès à la [balises méta](/fr/examples/scrape-meta-tags.html).
