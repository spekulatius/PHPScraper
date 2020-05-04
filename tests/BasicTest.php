<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class BasicTest extends TestCase
{
    /**
     * @test
     */
    public function testPageMissing()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');
        $this->assertSame("Page Not Found", $web->title);
    }

    /**
     * @test
     */
    public function testMethodAndPropertyCallsAreEqual()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page
        $web->go('https://test-pages.phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame("PHP Scraper - An oppinated web-scraper library for PHP", $web->title);
        $this->assertSame("PHP Scraper - An oppinated web-scraper library for PHP", $web->title());

        // so...
        $this->assertSame($web->title, $web->title());
    }

    /**
     * @test
     */
    public function testChangeOfCurrentPage()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page
        $web->go('https://test-pages.phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame("PHP Scraper - An oppinated web-scraper library for PHP", $web->title);


        // Leave the current page and head on to the next one.
        $web->go('https://github.com');

        // Shouldn't match, because we surfed on...
        $this->assertNotSame("PHP Scraper - An oppinated web-scraper library for PHP", $web->title);

        // Instead it should be GitHub now.
        // Side-note: The not signed-in title for GitHub is different.
        $this->assertSame("The world’s leading software development platform · GitHub", $web->title);
    }
}
