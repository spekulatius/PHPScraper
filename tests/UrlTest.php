<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

/**
 * Ensure our URL lib, https://github.com/thephpleague/uri, is integrated correctly and works as expected.
 */
class UrlTest extends TestCase
{
    /**
     * If null is passed to `makeUrlAbsolute`, it should always return null.
     *
     * @test
     */
    public function test_null_passing_through()
    {
        $web = new PHPScraper;

        $this->assertNull($web->makeUrlAbsolute(null));
    }

    /**
     * @test
     */
    public function validate_uri_test()
    {
        $web = new PHPScraper;

        // We use any URL for this.
        $web->go('https://test-pages.phpscraper.de/content/lists.html');

        // Ensure the URL is set correctly.
        $this->assertSame(
            'https://test-pages.phpscraper.de/content/lists.html',
            $web->currentUrl
        );

        // Ensure the host is parsed correctly.
        $this->assertSame(
            'test-pages.phpscraper.de',
            $web->currentHost
        );

        // Ensure the host with protocol is parsed correctly.
        $this->assertSame(
            'https://test-pages.phpscraper.de',
            $web->currentBaseHost
        );
    }

    /**
     * @test
     */
    public function test_current_base_host_with_base()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        // Contains: <base href="https://test-pages-with-base-href.phpscraper.de/">
        $web->go('https://test-pages.phpscraper.de/meta/image/absolute-path-with-base-href.html');

        // Check the base href being passed through the current base host.
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de',
            $web->currentBaseHost
        );
    }

    /**
     * Basic processing of the URLs.
     *
     * @test
     */
    public function test_make_url_absolute()
    {
        $web = new PHPScraper;

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
     * Basic processing of the URLs.
     *
     * @test
     */
    public function test_make_url_absolute_consider_base_href()
    {
        $web = new PHPScraper;

        /**
         * Navigate to test page: This sets the base URL.
         *
         * It contains:
         *
         * ```html
         * <base href="https://test-pages-with-base-href.phpscraper.de/">
         * ```
         *
         * While it's located on `test-pages.phpscraper.de`.
         *
         * This page isn't actually used. It's purely to set the context.
         */
        $web->go('https://test-pages.phpscraper.de/meta/image/absolute-path-with-base-href.html');

        // Test variations of paths to be processed
        // With leading slash
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de/index.html',
            $web->makeUrlAbsolute('/index.html'),
        );

        // Without leading slash
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de/index.html',
            $web->makeUrlAbsolute('index.html'),
        );

        // Paths are considered.
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de/test/index.html',
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
     * Test if passed in hosts are considered. It trumps any base-href and current url.
     *
     * @test
     */
    public function test_make_url_absolute_with_base_host()
    {
        $web = new PHPScraper;

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
            $web->makeUrlAbsolute('https://example.com/index.html', 'https://example-2.com/test/with/path'),
        );

        // Protocol is considered
        $this->assertSame(
            'http://example.com/index.html',
            $web->makeUrlAbsolute('http://example.com/index.html', 'https://example-2.com/test/with/path'),
        );
    }
}
