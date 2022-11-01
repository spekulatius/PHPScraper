<?php

namespace Tests;

class NavigationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSurfWithAbsoluteLink()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page #1.
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame($web->h1[0], 'Page #1');

        // Navigate to test page #2 using the absolute link.
        $web->clickLink('2 absolute');

        // Check the title and URL to see if we actually moved...
        $this->assertSame($web->h1[0], 'Page #2');
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/navigation/2.html');
    }

    /**
     * @test
     */
    public function testSurfWithRelativeLink()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page #1.
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame($web->h1[0], 'Page #1');

        // Navigate to test page #2 using the relative link.
        $web->clickLink('2 relative');

        // Check the title and URL to see if we actually moved...
        $this->assertSame($web->h1[0], 'Page #2');
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/navigation/2.html');
    }

    /**
     * @test
     */
    public function testLeavePageByText()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame($web->h1[0], 'Page #2');

        // Click the link with the text:
        $web->clickLink('external link');

        // Check the Url
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }

    /**
     * @test
     */
    public function testLeavePageWithRedirect()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame($web->h1[0], 'Page #2');

        // Click the link with the text:
        $web->clickLink('external link with redirect');

        // Check the Url
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }

    /**
     * @test
     */
    public function testLeavePageByURL()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page #2.
        $web->go('https://test-pages.phpscraper.de/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame($web->h1[0], 'Page #2');

        // Click the link with the text:
        $web->clickLink('https://peterthaleikis.com/');

        // Check the Url
        $this->assertSame('https://peterthaleikis.com/', $web->currentUrl);
    }
}
