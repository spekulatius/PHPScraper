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

        // Paths are resolved.
        $this->assertSame(
            $web->makeUrlAbsolute('../test/index.html'),
            'https://phpscraper.de/index.html',
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
