# PHPScraper CHANGELOG

All notable changes to this project will be documented in this file.

Parts regarding the [documentation website](https://phpscraper.de), the [test pages](https://github.com/spekulatius/phpscraper-test-pages) and individual documentation changes are omitted for better readability.

This project adheres to [Semantic Versioning](http://semver.org/).

## 0.11.0 (2022-11-01)

- [#137](https://github.com/spekulatius/PHPScraper/issues/137): [Fix download bug and improve testing](https://github.com/spekulatius/PHPScraper/commit/3a42adde3c9666a200f8b147e34b3ec09259d536)

## 0.10.0 (2022-11-01)

- [#136](https://github.com/spekulatius/PHPScraper/issues/136): Expand set of [URL-related methods](https://github.com/spekulatius/PHPScraper/commit/9293c7a81ca70f97cbef33469284846c355f8391)

## 0.9.0 (2022-10-28)

- [#79](https://github.com/spekulatius/PHPScraper/issues/79): Replace URL lib.

## 0.8.0 (2022-10-27)

- Maintenance: [Split Core lib](https://github.com/spekulatius/PHPScraper/commit/2ca34caae75e634442daf9c4f886060e41ba8911) for better understandably.

## 0.7.0 (2022-10-14)

- [Generalize Configuration API](https://github.com/spekulatius/PHPScraper/commit/e19baeb19658fbc4846c24eb597876f54c6012a3) for better usability.
- [#120](https://github.com/spekulatius/PHPScraper/issues/120): Proxy Support

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