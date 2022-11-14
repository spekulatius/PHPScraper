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

        // 1. Navigate to test page
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Both the method call as well as property call should return the same...
        $this->assertSame(
            'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
            $web->currentUrl
        );
        $this->assertSame(
            'Lorem Ipsum',
            $web->title
        );


        // 2. Leave the current page and head on to the next one.
        $web->go('https://phpscraper.de');

        // We should have navigated.
        $this->assertSame(
            'https://phpscraper.de',
            $web->currentUrl
        );

        // Shouldn't match, because we surfed on...
        $this->assertNotSame(
            'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
            $web->currentUrl
        );
        $this->assertNotSame(
            'Lorem Ipsum',
            $web->title
        );
    }

    /**
     * Calls should be chainable and easy to access.
     *
     * @test
     */
    public function testBasicChainability()
    {
        // Testing env: First h1: "We are testing here & elsewhere!"
        $url = 'https://test-pages.phpscraper.de/meta/html-entities.html';


        // Test 1: Create, navigate to the test page.
        $web = new \spekulatius\phpscraper;
        $web->go($url);

        // Check the h1
        $this->assertSame(
            'We are testing here & elsewhere!',
            $web->h1[0]
        );


        // Test 2: Chained
        $this->assertSame(
            'We are testing here & elsewhere!',

            // Chained
            (new \spekulatius\phpscraper)
                ->go($url)
                ->h1[0]
        );
    }
}
