<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class NavigationTest extends TestCase
{
    /**
     * @test
     */
    public function test_surf_with_absolute_link(): void
    {
        $web = new PHPScraper;

        // Navigate to test page #1.
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #1', $web->h1[0]);

        // Navigate to test page #2 using the absolute link.
        $web->clickLink('2 absolute');

        // Check the title and URL to see if we actually moved...
        $this->assertSame('Page #2', $web->h1[0]);
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/navigation/2.html');
    }

    /**
     * @test
     */
    public function test_surf_with_relative_link(): void
    {
        $web = new PHPScraper;

        // Navigate to test page #1.
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #1', $web->h1[0]);

        // Navigate to test page #2 using the relative link.
        $web->clickLink('2 relative');

        // Check the title and URL to see if we actually moved...
        $this->assertSame('Page #2', $web->h1[0]);
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/navigation/2.html');
    }

    /**
     * Test navigation using an anchor text.
     *
     * @test
     */
    public function test_leave_page_by_text(): void
    {
        $web = new PHPScraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('external link');

        // Check the URL
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }

    /**
     * Test if we can navigate out using a redirect.
     *
     * @test
     */
    public function test_leave_page_with_redirect(): void
    {
        $web = new PHPScraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('external link with redirect');

        // Check the URL
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }

    /**
     * Test if we can navigate out.
     *
     * @test
     */
    public function test_leave_page_by_url(): void
    {
        $web = new PHPScraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('https://peterthaleikis.com/');

        // Check the URL
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }

    /**
     * Test chainability of `clickLink`.
     *
     * @test
     */
    public function test_click_link_chainability(): void
    {
        $web = new PHPScraper;

        // Navigate to a page, click a link by URL and see if we are on the expected `currentUrl`.
        $web
            ->go('https://test-pages.phpscraper.de/navigation/2.html')
            ->clickLink('https://peterthaleikis.com/');

        // Check the URL
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }
}
