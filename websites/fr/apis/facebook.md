# API pour scraper Facebook

L'équipe à l'origine de PHP Scraper s'efforce de fournir des API commerciales pour divers cas d'utilisation courants ainsi que pour des plateformes. Ces API ne sont pas auto-hébergées. Vous n'aurez pas à vous soucier de la rotation des IPs/proxies, de l'utilisation d'un navigateur sans tête tel que Puppeteer. Un simple appel à l'API vous permettra d'obtenir toutes les informations requises. Les services seront fournis sur la base d'une structure tarifaire attractive dépendant de l'utilisation.

Pour Facebook, nous envisageons la mise en œuvre d'une API avec la portée suivante.

## Endpoints pris en charge proposés

- Utilisateur: profil utilisateur public
- Utilisateur: autres comptes sociaux
- Utilisateur: Liste d'amis
- Utilisateur: Images
- Utilisateur: Messages de localisation
- Utilisateur: Messages de l'utilisateur
- Groupes publics et groupes privés avec clé: Profil du groupe public
- Groupes publics et groupes privés avec clé: Liste des membres
- Public Groupes et groupes privés avec clé: Images
- Public Groupes et groupes privés avec clé: Messages de localisation
- Public Groupes et groupes privés avec clé: Messages
- Messages: Détails du message public (y compris les commentaires, les "likes", les "likers", etc.)

::: tip conseil
Veuillez noter que cette liste de points d'accès aux API n'est *pas* définitive et qu'elle est susceptible de changer.
:::

## Support de la plate-forme

Grâce à l'approche consistant à utiliser une API gérée, les utilisateurs n'ont plus à se soucier de la rotation des proxies, des problèmes de mise à l'échelle et des pannes. En outre, un large éventail de plateformes est pris en charge. Vous pouvez facilement intégrer NodeJS, Python (sans requests ou beautifulsoap), Golang, etc. Toute plateforme qui permet d'exécuter des requêtes GET peut être programmée pour demander des données à ce service.
