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
        $this->assertSame($web->title, $web->title());
    }

    /**
     * Test if our local variable is updated correctly.
     *
     * @test
     */
    public function testChangeOfCurrentPage()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Both the method call as well as property call should return the same...
        $this->assertSame(
            'Lorem Ipsum',
            $web->title
        );


        // Leave the current page and head on to the next one.
        $web->go('https://phpscraper.de');

        // Shouldn't match, because we surfed on...
        $this->assertNotSame(
            'Lorem Ipsum',
            $web->title
        );
    }

    /**
     * Calls should be chainable.
     *
     * @test
     */
    public function testBasicChainability()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to test page
        $web->go('https://phpscraper.de');

        $this->assertSame(
            // Unchained
            $web->title,

            // Chained
            (new \spekulatius\phpscraper)
                ->go('https://phpscraper.de')
                ->title
        );
    }
}
