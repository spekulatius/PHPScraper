# Upgrading PHPScraper

This document will help you upgrading PHPScraper from an earlier version to later versions.

## From `0.x` to `1.x`

- The namespace has been adjusted from `\spekulatius` to `\Spekulatius\PHPScraper`. Any `use` statements or other class references need to updated accordingly:

  ```diff
  -use spekulatius\phpscraper;
  +use Spekulatius\PHPScraper\PHPScraper;
  ```

  or

  ```diff
  -$web = new \spekulatius\phpscraper;
  +$web = new \Spekulatius\PHPScraper\PHPScraper;
  ```

## From `1.x` to `2.x`

- Support for PHP 7.x was dropped. PHP 8.0 is the minimum for v2.
- The publicly accessible function `parseXML` was renamed to `parseXml`.
- The codebase has been analysed with PHPStan and hardened manually. Due to this, some return types have changed. See [v2 pull request](https://github.com/spekulatius/PHPScraper/pull/187/files) for details.
