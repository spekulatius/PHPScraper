<?php

namespace Spekulatius\PHPScraper\Tests;

class NavigationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSurfWithAbsoluteLink()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testSurfWithRelativeLink()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testLeavePageByText()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testLeavePageWithRedirect()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testLeavePageByURL()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testClickLinkChainability()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to a page, click a link by URL and see if we are on the expected `currentUrl`.
        $web
            ->go('https://test-pages.phpscraper.de/navigation/2.html')
            ->clickLink('https://peterthaleikis.com/');

        // Check the URL
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }
}
