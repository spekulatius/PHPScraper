# Upgrading PHPScraper

This document will help you upgrading PHPScraper from one version to a new one.

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