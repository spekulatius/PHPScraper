---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Content&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Texto de raspado

El raspado de contenido, sobre todo de párrafos, se puede hacer fácilmente usando PHP Scraper. Hay un método dedicado para acceder a los párrafos (`<p>`) en un sitio web. Los siguientes ejemplos muestran cómo acceder al contenido/textos de un sitio web.


## Obtener todos los párrafos

El siguiente ejemplo devolverá una lista de todos los párrafos (etiquetas `<p>`) del sitio web:

```php
$web = new \spekulatius\phpscraper;

// Navegue a la página de prueba. Contiene 6 párrafos lorem ipsum
$web->go('https://test-pages.phpscraper.de/content/paragraphs.html');

// Comprueba el número de párrafos.
echo "Esta página contiene " . count($web->paragraphs) . " párrafos.\n\n";

// Recorrer los párrafos en bucle
foreach ($web->paragraphs as $paragraph) {
    echo " - " . $paragraph . "\n";
}

/**
 * Se imprimirá:
 *
 * Esta página contiene 6 apartados.
 *
 * - Maecenas eget ex sit amet urna porta fermentum at ut dui. Praesent lectus arcu, hendrerit sed mi vel, commodo lacinia velit. Nullam ac velit quis ante tristique scelerisque quis non metus. Pellentesque non aliquam elit, in tincidunt purus. Vestibulum fringilla cursus risus, eget ornare dolor feugiat vitae. Sed non porta lorem, eget ornare diam. Sed quam est, eleifend porttitor imperdiet sit amet, ultricies vel ipsum. Pellentesque mauris mauris, fermentum pretium ex quis, viverra mattis est. Donec laoreet sem nec arcu rhoncus lobortis. Duis id orci vel enim interdum aliquam. Integer eu ex ligula. Ut mattis nisi non malesuada ornare. In elit ligula, ultricies a aliquet eget, dictum sit amet neque. Quisque nulla sem, aliquam id molestie iaculis, consequat at augue. Nullam sollicitudin finibus eros in venenatis. Donec semper sagittis ipsum, et rhoncus magna ultricies eu.

 * - Quisque sed dolor ut nunc accumsan lacinia. Suspendisse vel eros faucibus massa feugiat tristique. Nullam vitae scelerisque felis, malesuada hendrerit felis. Quisque eleifend mi lorem, vitae elementum dolor bibendum et. Etiam et faucibus augue. Pellentesque viverra sagittis consequat. Nulla a mollis ex. Sed vel nisl mauris. Nulla consequat dui sed pulvinar interdum. Integer vehicula molestie quam non fringilla. Duis auctor sem ut purus fringilla, in lacinia dui finibus. Nulla rhoncus semper velit, eget semper tellus suscipit eget. Vestibulum massa tellus, tristique sit amet dolor et, ullamcorper porta turpis. Vivamus eget magna lacinia, pretium sem sed, gravida libero.

 * - Ut at nunc laoreet, vestibulum mauris in, volutpat magna. Aliquam sodales orci finibus porta convallis. Vestibulum sollicitudin felis a sem consequat luctus. Sed laoreet porta quam, non pharetra massa mattis semper. Phasellus aliquet tortor ut felis scelerisque, non dapibus justo tincidunt. Donec eu pulvinar nisi, sit amet elementum massa. Nulla in odio est. In neque ligula, tristique rhoncus orci eu, egestas ullamcorper est. Integer rhoncus vel quam vel placerat. In nec metus pellentesque elit accumsan molestie eu posuere odio. Sed at eros nec turpis vestibulum eleifend vel in erat. Etiam vel metus faucibus, tempus enim nec, elementum arcu. Ut nec blandit risus. Nam sapien nunc, tristique sit amet facilisis non, maximus a nulla. Pellentesque vel posuere libero.

 * - Morbi volutpat purus odio, vitae scelerisque diam consectetur sed. Cras turpis leo, hendrerit in tempus et, convallis in nibh. Mauris molestie facilisis odio, ac egestas erat ultrices pellentesque. Donec interdum leo quis ipsum sagittis venenatis. Etiam scelerisque mi at metus ullamcorper, vitae tristique est tincidunt. Vestibulum ut congue urna, eu sagittis quam. Phasellus eget arcu sapien. In hac habitasse platea dictumst. Morbi ultrices, felis in faucibus ornare, libero augue scelerisque urna, et feugiat nisl est ut velit. Phasellus felis quam, egestas a faucibus nec, dictum eget enim. In tempor a lacus id facilisis.

 * - Donec bibendum finibus neque quis viverra. Ut ut nulla venenatis, accumsan purus nec, ullamcorper nisi. Nulla bibendum dui sit amet velit venenatis, eget viverra nibh accumsan. Fusce pharetra, sem eu mattis varius, massa leo eleifend lectus, quis tempor elit ipsum sit amet lorem. Fusce viverra dictum tortor non sodales. Phasellus at lectus quis arcu finibus imperdiet sed eleifend nulla. Donec blandit egestas nibh ac euismod. Curabitur ac pretium eros.

 * - Duis pharetra magna at dolor scelerisque, nec luctus ex pretium. Suspendisse a ante lectus. Donec vehicula condimentum turpis, in hendrerit dui suscipit non. Nullam a ultricies felis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent aliquet varius mauris nec pretium. Vivamus convallis tincidunt nisi, eget scelerisque dolor facilisis vitae. Pellentesque purus neque, sollicitudin sit amet mauris id, posuere posuere mi. Etiam vitae urna vitae turpis volutpat consectetur. Quisque ultrices, ex dapibus hendrerit convallis, diam massa suscipit diam, vulputate pharetra mi orci at massa. Aliquam vel urna tempor, congue justo id, pulvinar lorem. Nulla mattis vitae justo sed molestie. Nunc fermentum fringilla nibh, id fermentum nulla. Sed tincidunt ipsum id est efficitur, molestie aliquet lacus hendrerit. Fusce et nisl eros.
 */
```


## Raspando el primer párrafo

La extracción del primer párrafo de la página web puede hacerse accediendo al primer elemento del array (índice 0).

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/content/paragraphs.html');

echo $web->paragraphs[0];
/**
 * Imprime el primer párrafo:
 *
 * Maecenas eget ex sit amet urna porta fermentum at ut dui. Praesent lectus arcu, hendrerit sed mi vel, commodo lacinia velit. Nullam ac velit quis ante tristique scelerisque quis non metus. Pellentesque non aliquam elit, in tincidunt purus. Vestibulum fringilla cursus risus, eget ornare dolor feugiat vitae. Sed non porta lorem, eget ornare diam. Sed quam est, eleifend porttitor imperdiet sit amet, ultricies vel ipsum. Pellentesque mauris mauris, fermentum pretium ex quis, viverra mattis est. Donec laoreet sem nec arcu rhoncus lobortis. Duis id orci vel enim interdum aliquam. Integer eu ex ligula. Ut mattis nisi non malesuada ornare. In elit ligula, ultricies a aliquet eget, dictum sit amet neque. Quisque nulla sem, aliquam id molestie iaculis, consequat at augue. Nullam sollicitudin finibus eros in venenatis. Donec semper sagittis ipsum, et rhoncus magna ultricies eu.
 */
```

Los p-tags vacíos conducirían a cadenas vacías en el array devuelto. Para evitar esto puede llamar a `$web->cleanParagraphs` en su lugar. Esto filtrará los párrafos vacíos y sólo devolverá los que tengan contenido. Para acceder al primer párrafo con contenido utilice `$web->cleanParagraphs[0]`.
