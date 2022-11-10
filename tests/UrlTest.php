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
        $this->assertSame('https://test-pages.phpscraper.de/content/lists.html', $web->currentUrl);

        // Ensure the host is parsed correctly.
        $this->assertSame('test-pages.phpscraper.de', $web->currentHost);

        // Ensure the host with protocol is parsed correctly.
        $this->assertSame('https://test-pages.phpscraper.de', $web->currentBaseHost);
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
            'https://phpscraper.de/index.html',
            $web->makeUrlAbsolute('/index.html'),
        );

        // Without leading slash
        $this->assertSame(
            'https://phpscraper.de/index.html',
            $web->makeUrlAbsolute('index.html'),
        );

        // Paths are considered.
        $this->assertSame(
            'https://phpscraper.de/test/index.html',
            $web->makeUrlAbsolute('test/index.html'),
        );

        // Absolutely URLs are untouched.
        $this->assertSame(
            'https://example.com/index.html',
            $web->makeUrlAbsolute('https://example.com/index.html'),
        );

        // Protocol is considered
        $this->assertSame(
            'http://example.com/index.html',
            $web->makeUrlAbsolute('http://example.com/index.html'),
        );
    }

    /**
     * @test
     */
    public function testMakeUrlAbsoluteWithBaseHost()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page: This sets the base URL.
        $web->go('https://phpscraper.de');

        // Test variations of paths to be processed
        // With leading slash
        $this->assertSame(
            'https://example.com/index.html',
            $web->makeUrlAbsolute('/index.html', 'https://example.com'),
        );

        // Without leading slash
        $this->assertSame(
            'https://example.com/index.html',
            $web->makeUrlAbsolute('index.html', 'https://example.com'),
        );

        // Paths are considered.
        $this->assertSame(
            'https://example.com/test/index.html',
            $web->makeUrlAbsolute('test/index.html', 'https://example.com'),
        );

        // Absolutely URLs are untouched.
        $this->assertSame(
            'https://example.com/index.html',
            $web->makeUrlAbsolute('https://example.com/index.html', 'https://example.com/test/with/path'),
        );

        // Protocol is considered
        $this->assertSame(
            'http://example.com/index.html',
            $web->makeUrlAbsolute('http://example.com/index.html', 'https://example.com/test/with/path'),
        );
    }
}
