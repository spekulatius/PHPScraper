# Installation

Die Installation erfolgt normalerweise mit [Composer] (https://getcomposer.org).

## Installation mit Composer

```bash
composer require spekulatius/phpscraper
```

## Verwendung in VanillaPHP-Projekten

Nach Abschluss der Installation wird das Paket vom Composer-Autoloader geladen.

Wenn Sie ein VanillaPHP-Projekt bauen, müssen Sie den Autoloader oben im Skript einbinden:

```php
require 'vendor/autoload.php';
```

Wenn Sie ein Framework wie Laravel, Symfony, Zend, Phalcon, or CakePHP verwenden, brauchen Sie diesen Schritt nicht.
