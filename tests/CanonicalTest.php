<?php

namespace Spekulatius\PHPScraper\Tests;

class CanonicalTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCanonical()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a canonical set.
        $this->assertNull($web->canonical);
    }

    /**
     * @test
     */
    public function testWithCanonical()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        // It contains: <link rel="canonical" href="https://test-pages.phpscraper.de/navigation/2.html" />
        $web->go('https://test-pages.phpscraper.de/navigation/1.html');

        // Check the canonical
        $this->assertSame(
            'https://test-pages.phpscraper.de/navigation/2.html',
            $web->canonical
        );
    }
}
