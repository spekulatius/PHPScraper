# Installation

The installation usually is done using [Composer](https://getcomposer.org).

## Installation with Composer

```bash
composer require spekulatius/phpscraper
```

## Usage in VanillaPHP-Projects

After the installation is completed the package will be picked up by the Composer autoloader.

If you are building a VanillaPHP project, you will need to include the autoloader in your script at the top of your PHP script:

```php
require 'vendor/autoload.php';
```

If you are using a framework such as Laravel, Symfony, Zend, Phalcon, or CakePHP, you won't need this step. The autoloader is automatically included.
