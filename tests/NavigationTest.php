<?php

namespace Tests;

class NavigationTest extends BaseTest
{
    /**
     * @test
     */
    public function testSurfWithAbsoluteLink()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page #1.
        $web->go($this->url . '/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #1', $web->h1[0]);

        // Navigate to test page #2 using the absolute link.
        $web->clickLink('2 absolute');

        // Check the title to see if we actually moved...
        $this->assertSame('Page #2', $web->h1[0]);
    }

    /**
     * @test
     */
    public function testSurfWithRelativeLink()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page 1.
        $web->go($this->url . '/navigation/1.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #1', $web->h1[0]);

        // Navigate to test page #1 using the absolute link.
        $web->clickLink('2 relative');

        // Check the title to see if we actually moved...
        $this->assertSame('Page #2', $web->h1[0]);
    }

    /**
     * @test
     */
    public function testLeavePageByText()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page 2.
        $web->go($this->url . '/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('external link');

        // Check the title
        // @todo: confirm issue
        // $this->assertSame('https://peterthaleikis.com/', $web->currentURL);
    }

    /**
     * @test
     */
    public function testLeavePageWithRedirect()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page 2.
        $web->go($this->url . '/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('external link with redirect');

        // Check the title
        // @todo: confirm issue
        // $this->assertSame('https://peterthaleikis.com/', $web->currentURL);
    }

    /**
     * @test
     */
    public function testLeavePageByURL()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/navigation/2.html');

        // Check the title to see if we actually at the right page...
        $this->assertSame('Page #2', $web->h1[0]);

        // Click the link with the text:
        $web->clickLink('https://peterthaleikis.com/');

        // Check the title
        $this->assertSame('https://peterthaleikis.com/', $web->currentURL);
    }
}
