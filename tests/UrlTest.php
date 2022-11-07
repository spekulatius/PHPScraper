<?php

namespace Tests;

/**
 * Ensure our URL lib, https://github.com/thephpleague/uri, is integrated correctly and works as expected.
 */

class UrlTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function validateUriTest()
    {
        $web = new \spekulatius\phpscraper;

        // We use any URL for this.
        $web->go('https://test-pages.phpscraper.de/content/lists.html');

        // Ensure the URL is set correctly.
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/content/lists.html');

        // Ensure the host is parsed correctly.
        $this->assertSame($web->currentHost, 'test-pages.phpscraper.de');

        // Ensure the host with protocol is parsed correctly.
        $this->assertSame($web->currentBaseUrl, 'https://test-pages.phpscraper.de');
    }

    /**
     * @test
     */
    public function testMakeUrlAbsolute()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page: This sets the base URL.
        $web->go('https://phpscraper.de');

        // Test variations of paths to be processed
        // With leading slash
        $this->assertSame(
            $web->makeUrlAbsolute('/index.html'),
            'https://phpscraper.de/index.html',
        );

        // Without leading slash
        $this->assertSame(
            $web->makeUrlAbsolute('index.html'),
            'https://phpscraper.de/index.html',
        );

        // Folders are considered.
        $this->assertSame(
            $web->makeUrlAbsolute('test/index.html'),
            'https://phpscraper.de/test/index.html',
        );

        // Absolutely URLs are untouched.
        $this->assertSame(
            $web->makeUrlAbsolute('https://example.com/index.html'),
            'https://example.com/index.html',
        );

        // Protocol is considered
        $this->assertSame(
            $web->makeUrlAbsolute('http://example.com/index.html'),
            'http://example.com/index.html',
        );
    }
}
