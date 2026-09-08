<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class CanonicalTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_canonical(): void
    {
        $web = new PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a canonical set.
        $this->assertNull($web->canonical);
    }

    /**
     * @test
     */
    public function test_with_canonical(): void
    {
        $web = new PHPScraper;

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
