<?php

namespace Tests;

class CoreTest extends BaseTest
{
    /**
     * @test
     */
    public function testMethodAndPropertyCallsAreEqual()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page
        $web->go('https://phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame(
            "PHP Scraper - An opinionated web-scraping library for PHP",
            $web->title
        );
        $this->assertSame(
            "PHP Scraper - An opinionated web-scraping library for PHP",
            $web->title()
        );

        // So...
        $this->assertSame($web->title, $web->title());
    }

    /**
     * @test
     */
    public function testChangeOfCurrentPage()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to test page
        $web->go('https://phpscraper.de');

        // Both the method call as well as property call should return the same...
        $this->assertSame(
            "PHP Scraper - An opinionated web-scraping library for PHP",
            $web->title
        );


        // Leave the current page and head on to the next one.
        $web->go('https://github.com');

        // Shouldn't match, because we surfed on...
        $this->assertNotSame(
            "PHP Scraper - An opinionated web-scraping library for PHP",
            $web->title
        );
    }
}
