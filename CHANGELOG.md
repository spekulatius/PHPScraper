# PHPScraper CHANGELOG

All notable changes to this project will be documented in this file.

Parts regarding the [documentation website](https://phpscraper.de), the [test pages](https://github.com/spekulatius/phpscraper-test-pages) and individual documentation changes are omitted for better readability.

This project adheres to [Semantic Versioning](http://semver.org/).

## 3.0.0 (2024-04-09)

- [#204](https://github.com/spekulatius/PHPScraper/pull/204): Upgrading Symfony dependencies to allow ^7.0
- [#201](https://github.com/spekulatius/PHPScraper/pull/201): Pint
- [#200](https://github.com/spekulatius/PHPScraper/pull/200): Upgrade from league/uri 6.x to league/uri 7.x, replacing deprecated function use with new recommended ones
- [#199](https://github.com/spekulatius/PHPScraper/pull/199): Add CI job names
- [#196](https://github.com/spekulatius/PHPScraper/pull/196): Upgrading repo tools
- [#195](https://github.com/spekulatius/PHPScraper/pull/195): Add Pint
- [#194](https://github.com/spekulatius/PHPScraper/pull/194): Fix HTTPClient config
- [#192](https://github.com/spekulatius/PHPScraper/pull/192): Fix few problems reported by PHPStan
- [#190](https://github.com/spekulatius/PHPScraper/pull/190): Fix typos and a critical error
- [#188](https://github.com/spekulatius/PHPScraper/pull/188): Move phpstan to local temp path to ensure Windows users can run it

## 2.0.0 (2023-06-01)

- [#187](https://github.com/spekulatius/PHPScraper/issues/187): Prepare v2: Improve typing, bringing PHPStan to --level=9. For details check the [CHANGELOG](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md#from-1x-to-2x).
- [#188](https://github.com/spekulatius/PHPScraper/issues/188): Support PHPStan for Windows Users
- [#185](https://github.com/spekulatius/PHPScraper/issues/185): Adding PHP 8.3 to test pipeline
- [#184](https://github.com/spekulatius/PHPScraper/issues/184): Adding PHPStan GitHub Action. Thank you @nadar!
- [#183](https://github.com/spekulatius/PHPScraper/issues/183): Switch from Goutte to BrowserKit
- [#182](https://github.com/spekulatius/PHPScraper/issues/182): Drop PHP 7.3 and 7.4
- [#174](https://github.com/spekulatius/PHPScraper/issues/174): Fix local testing
- [#173](https://github.com/spekulatius/PHPScraper/issues/173): Fix README example
- [#171](https://github.com/spekulatius/PHPScraper/issues/171): Various PHPStan improvements
- [#169](https://github.com/spekulatius/PHPScraper/issues/169): Adding `<meta charset=...>` extraction

## 1.0.2 (2022-12-15)

- [#167](https://github.com/spekulatius/PHPScraper/issues/167): Updating CHANGELOG.md
- [#166](https://github.com/spekulatius/PHPScraper/issues/166): Minor tidy ups in comments
- [#165](https://github.com/spekulatius/PHPScraper/issues/165): Adding PHP 8.2 to test workflow
- [#160](https://github.com/spekulatius/PHPScraper/issues/160): Allow complete interface for HttpClient instead of only one class.

## 1.0.1 (2022-12-02)

- [#156](https://github.com/spekulatius/PHPScraper/issues/156): Tidy up: Make file naming more intuitive and fix comments
- [#154](https://github.com/spekulatius/PHPScraper/issues/154): Expose GoutteClient as an accessible property

## 1.0.0 (2022-11-24)

- [#151](https://github.com/spekulatius/PHPScraper/issues/151): Migrate website into separate repo.
- [#150](https://github.com/spekulatius/PHPScraper/issues/150): Switch namespaces. See [UPGRADING](https://github.com/spekulatius/PHPScraper/blob/master/UPGRADING.md) for more details.
- [#147](https://github.com/spekulatius/PHPScraper/issues/147): Prepare for v1.0

## 0.13.0 (2022-11-21)

- [#146](https://github.com/spekulatius/PHPScraper/issues/146): Implement plain text file/URL parsing.

## 0.12.0 (2022-11-10)

- [#142](https://github.com/spekulatius/PHPScraper/issues/142): Implement feed parsing.
- [#145](https://github.com/spekulatius/PHPScraper/issues/145): Re-enable previously deactivated tests

## 0.11.0 (2022-11-01)

- [#137](https://github.com/spekulatius/PHPScraper/issues/137): Fix download bug and improve testing

## 0.10.0 (2022-11-01)

- [#136](https://github.com/spekulatius/PHPScraper/issues/136): Expand set of URL-related methods

## 0.9.0 (2022-10-28)

- [#79](https://github.com/spekulatius/PHPScraper/issues/79): Replace URL lib. Sub-domain support dropped.

## 0.8.0 (2022-10-27)

- Maintenance: [Split Core lib](https://github.com/spekulatius/PHPScraper/commit/2ca34caae75e634442daf9c4f886060e41ba8911) for better understandably.

## 0.7.0 (2022-10-14)

- [Generalize Configuration API](https://github.com/spekulatius/PHPScraper/commit/e19baeb19658fbc4846c24eb597876f54c6012a3) for better usability.
- [Proxy Support](https://github.com/spekulatius/PHPScraper/commit/326bdff4430a326bdb08f6af8452f148250c7784)

## 0.6.0 (2022-07-14)

- [#77](https://github.com/spekulatius/PHPScraper/issues/77): Upgrade to allow Symfony 6

## 0.5.0 (2022-08-16)

- Add [`rel`-interpretation](https://github.com/spekulatius/PHPScraper/commit/47d6f8a0f6adf49de31b691b98ea472a4a382b9f) to link methods.
- Add support to BYO-HTML: [`setContent`](https://github.com/spekulatius/PHPScraper/commit/9c50d145f280732e26ecf83c8d2978c07466dfcd).
- Improve typing support
- [Add Lists](https://github.com/spekulatius/PHPScraper/commit/0aac52853ab394d9f38b004e401c5fbec328e017)

## 0.4.0 (2022-08-16)

- Add [keyword scoring](https://github.com/spekulatius/PHPScraper/commit/e91bce24e4b53d9a1ef19b3f1ded97627eb2076e) in.

## 0.3.0 (2022-06-20)

- Add [keyword extraction](https://github.com/spekulatius/PHPScraper/commit/9d20004ead5b9e8350a03fa6fc4de1477b19bd4c) lib in.

## 0.2.0 (2022-06-20)

- Adding [support for `internalLinks` & `externalLinks`](https://github.com/spekulatius/PHPScraper/commit/193f422f206b7a10586463fff4a7f9dcc9e896f9).

## 0.1.0 (2022-05-04)

- Start testing using PHPUnit.
- Drop keeping own copy of current URL.
- Initial commit with basics functionality.