---
image: https://api.imageee.com/bold?text=PHP:%20Scraping%20Content&bg_image=https://images.unsplash.com/photo-1542762933-ab3502717ce7
---

# Scrapen von Text

Das Scraping von Inhalten, vor allem von Absätzen, kann mit PHP Scraper leicht durchgeführt werden. Es gibt eine spezielle Methode, um auf die Absätze (`<p>`) einer Website zuzugreifen. Die folgenden Beispiele zeigen, wie man auf den Inhalt/Text einer Website zugreifen kann.


## Alle Absätze abrufen

Das folgende Beispiel gibt eine Liste aller Absätze (`<p>`-Tags) auf der Website zurück:

```php
$web = new \spekulatius\phpscraper;

// Navigation zur Testseite. Diese enthält 6 "lorem ipsum"-Absätze:
$web->go('https://test-pages.phpscraper.de/content/paragraphs.html');

// Überprüfen der Anzahl der Absätze:
echo "Diese Seite enthält " . count($web->paragraphs) . " Paragraphen.\n\n";

// Schleife durch die Absätze:
foreach ($web->paragraphs as $paragraph) {
    echo " - " . $paragraph . "\n";
}

/**
 * Ausgegeben wird:
 *
 * Diese Seite enthält 6 Absätze.
 *
 * - Maecenas eget ex sit amet urna porta fermentum at ut dui. Praesent lectus arcu, hendrerit sed mi vel, commodo lacinia velit. Nullam ac velit quis ante tristique scelerisque quis non metus. Pellentesque non aliquam elit, in tincidunt purus. Vestibulum fringilla cursus risus, eget ornare dolor feugiat vitae. Sed non porta lorem, eget ornare diam. Sed quam est, eleifend porttitor imperdiet sit amet, ultricies vel ipsum. Pellentesque mauris mauris, fermentum pretium ex quis, viverra mattis est. Donec laoreet sem nec arcu rhoncus lobortis. Duis id orci vel enim interdum aliquam. Integer eu ex ligula. Ut mattis nisi non malesuada ornare. In elit ligula, ultricies a aliquet eget, dictum sit amet neque. Quisque nulla sem, aliquam id molestie iaculis, consequat at augue. Nullam sollicitudin finibus eros in venenatis. Donec semper sagittis ipsum, et rhoncus magna ultricies eu.

 * - Quisque sed dolor ut nunc accumsan lacinia. Suspendisse vel eros faucibus massa feugiat tristique. Nullam vitae scelerisque felis, malesuada hendrerit felis. Quisque eleifend mi lorem, vitae elementum dolor bibendum et. Etiam et faucibus augue. Pellentesque viverra sagittis consequat. Nulla a mollis ex. Sed vel nisl mauris. Nulla consequat dui sed pulvinar interdum. Integer vehicula molestie quam non fringilla. Duis auctor sem ut purus fringilla, in lacinia dui finibus. Nulla rhoncus semper velit, eget semper tellus suscipit eget. Vestibulum massa tellus, tristique sit amet dolor et, ullamcorper porta turpis. Vivamus eget magna lacinia, pretium sem sed, gravida libero.

 * - Ut at nunc laoreet, vestibulum mauris in, volutpat magna. Aliquam sodales orci finibus porta convallis. Vestibulum sollicitudin felis a sem consequat luctus. Sed laoreet porta quam, non pharetra massa mattis semper. Phasellus aliquet tortor ut felis scelerisque, non dapibus justo tincidunt. Donec eu pulvinar nisi, sit amet elementum massa. Nulla in odio est. In neque ligula, tristique rhoncus orci eu, egestas ullamcorper est. Integer rhoncus vel quam vel placerat. In nec metus pellentesque elit accumsan molestie eu posuere odio. Sed at eros nec turpis vestibulum eleifend vel in erat. Etiam vel metus faucibus, tempus enim nec, elementum arcu. Ut nec blandit risus. Nam sapien nunc, tristique sit amet facilisis non, maximus a nulla. Pellentesque vel posuere libero.

 * - Morbi volutpat purus odio, vitae scelerisque diam consectetur sed. Cras turpis leo, hendrerit in tempus et, convallis in nibh. Mauris molestie facilisis odio, ac egestas erat ultrices pellentesque. Donec interdum leo quis ipsum sagittis venenatis. Etiam scelerisque mi at metus ullamcorper, vitae tristique est tincidunt. Vestibulum ut congue urna, eu sagittis quam. Phasellus eget arcu sapien. In hac habitasse platea dictumst. Morbi ultrices, felis in faucibus ornare, libero augue scelerisque urna, et feugiat nisl est ut velit. Phasellus felis quam, egestas a faucibus nec, dictum eget enim. In tempor a lacus id facilisis.

 * - Donec bibendum finibus neque quis viverra. Ut ut nulla venenatis, accumsan purus nec, ullamcorper nisi. Nulla bibendum dui sit amet velit venenatis, eget viverra nibh accumsan. Fusce pharetra, sem eu mattis varius, massa leo eleifend lectus, quis tempor elit ipsum sit amet lorem. Fusce viverra dictum tortor non sodales. Phasellus at lectus quis arcu finibus imperdiet sed eleifend nulla. Donec blandit egestas nibh ac euismod. Curabitur ac pretium eros.

 * - Duis pharetra magna at dolor scelerisque, nec luctus ex pretium. Suspendisse a ante lectus. Donec vehicula condimentum turpis, in hendrerit dui suscipit non. Nullam a ultricies felis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent aliquet varius mauris nec pretium. Vivamus convallis tincidunt nisi, eget scelerisque dolor facilisis vitae. Pellentesque purus neque, sollicitudin sit amet mauris id, posuere posuere mi. Etiam vitae urna vitae turpis volutpat consectetur. Quisque ultrices, ex dapibus hendrerit convallis, diam massa suscipit diam, vulputate pharetra mi orci at massa. Aliquam vel urna tempor, congue justo id, pulvinar lorem. Nulla mattis vitae justo sed molestie. Nunc fermentum fringilla nibh, id fermentum nulla. Sed tincidunt ipsum id est efficitur, molestie aliquet lacus hendrerit. Fusce et nisl eros.
 */
```


## Scrapen des ersten Absatzes

Das Scraping des ersten Absatzes der Website kann durch Zugriff auf das erste Element des Arrays (Index 0) erfolgen.

```php
$web = new \spekulatius\phpscraper;
$web->go('https://test-pages.phpscraper.de/content/paragraphs.html');

echo $web->paragraphs[0];
/**
 * Gibt den ersten Absatz aus:
 *
 * Maecenas eget ex sit amet urna porta fermentum at ut dui. Praesent lectus arcu, hendrerit sed mi vel, commodo lacinia velit. Nullam ac velit quis ante tristique scelerisque quis non metus. Pellentesque non aliquam elit, in tincidunt purus. Vestibulum fringilla cursus risus, eget ornare dolor feugiat vitae. Sed non porta lorem, eget ornare diam. Sed quam est, eleifend porttitor imperdiet sit amet, ultricies vel ipsum. Pellentesque mauris mauris, fermentum pretium ex quis, viverra mattis est. Donec laoreet sem nec arcu rhoncus lobortis. Duis id orci vel enim interdum aliquam. Integer eu ex ligula. Ut mattis nisi non malesuada ornare. In elit ligula, ultricies a aliquet eget, dictum sit amet neque. Quisque nulla sem, aliquam id molestie iaculis, consequat at augue. Nullam sollicitudin finibus eros in venenatis. Donec semper sagittis ipsum, et rhoncus magna ultricies eu.
 */
```

Leere p-tags würden zu leeren Strings im zurückgegebenen Array führen. Um dies zu vermeiden, können Sie stattdessen `$web->cleanParagraphs` aufrufen. Dadurch werden leere Absätze herausgefiltert und nur solche mit Inhalt zurückgegeben. Um auf den ersten Absatz mit Inhalt zuzugreifen, verwenden Sie `$web->cleanParagraphs[0]`.
