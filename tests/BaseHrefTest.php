<?php

namespace Spekulatius\PHPScraper\Tests;

/**
 * This tests only the `<base href="...">`-extraction.
 *
 * If you are looking for any URL-related tests check `UrlTest.php`.
 */
class BaseHrefTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingBaseHref()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the baseHref as not given (null)
        $this->assertNull($web->baseHref);
    }

    /**
     * @test
     */
    public function testBaseHref()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        // Contains: <base href="https://test-pages-with-base-href.phpscraper.de/">
        $web->go('https://test-pages.phpscraper.de/meta/image/absolute-path-with-base-href.html');

        // Check the baseHref
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de/',
            $web->baseHref
        );
    }

    public function testBaseHrefContainRelativePath()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper(['disable_ssl' => true]);

        // Navigate to the test page.
        // Contains: <base href="/links/invalid-base-href.html"> (relative path)
        $web->go('https://test-pages.phpscraper.de/links/invalid-base-href.html');
        // Check the baseHref
        $this->assertSame(
            '/links/invalid-base-href.html',
            $web->baseHref
        );
    }
}
