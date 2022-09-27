<?php

namespace Tests;

class CoreTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMethodAndPropertyCallsAreEqual()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page
        $web->go('https://phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame($web->title(), $web->title);

        // So...
        $this->assertSame($web->title, $web->title());
    }

    /**
     * @test
     */
    public function testChangeOfCurrentPage()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page
        $web->go('https://phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame(
            'PHP Scraper: Bringing Simplicity back to Scraping and Crawling',
            $web->title
        );


        // Leave the current page and head on to the next one.
        $web->go('https://github.com');

        // Shouldn't match, because we surfed on...
        $this->assertNotSame(
            'PHP Scraper: Bringing Simplicity back to Scraping and Crawling',
            $web->title
        );
    }
}
