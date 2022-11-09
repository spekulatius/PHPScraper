<?php

namespace Tests;

class CanonicalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCanonical()
    {
        $web = new \spekulatius\phpscraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a canonical set.
        $this->assertSame(null, $web->canonical);
    }

    /**
     * @test
     */
    public function testWithCanonical()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to the test page.
        // It contains: <link rel="canonical" href="http://localhost:8089/navigation/2.html" />
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the canonical
        $this->assertSame(
            'https://test-pages.phpscraper.de/navigation/2.html',
            $web->canonical
        );
    }
}
