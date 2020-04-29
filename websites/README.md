An *oppinated* web-access library for PHP
===================================================

*by [Peter Thaleikis](https://peterthaleikis.com)*

Accessing the web from PHP can done easier. This is an oppinated wrapper around some great libraries.

Check the examples to get an idea.


Idea
----

Access websites and collecting basic information of the web is too complex. This wrapper around [Goutte](https://github.com/FriendsOfPHP/Goutte) makes it easier. It saves you from XPath and co., giving you direct access to everything you need.


Examples
--------

Here are some examples what the library can do at this point:

`// @TODO paste examples...`

More example code can be found in the sidebar.


Installation
------------

As usual, done via composer:

`composer install spekulatius/phpscraper`

This automatically ensures the package is loaded. You can now use any of the above noted examples.


Contributing
------------

Awesome, if you like contribute please check the [guidelines](/contributing) before getting started.


Tests
-----

The code is roughly covered with end-to-end tests. For this, simple web-pages are hosted under *https://test-pages.phpscraper.de/*, loaded and parsed using [PHPUnit](https://phpunit.de/). These tests are also suitable as examples - see `tests/`!

This being said, there are probably edge cases which aren't working and more cause trouble. If you find one, please raise a bug on GitHub.
