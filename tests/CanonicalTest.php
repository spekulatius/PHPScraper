<?php

namespace Tests;

use spekulatius;
use PHPUnit\Framework\TestCase;

final class CanonicalTest extends TestCase
{
    /**
     * @test
     */
    public function testMissingCanonical()
    {
        $web = new \spekulatius\phpscraper();

        // Attempt to check Google
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a canonical set.
        $this->assertSame(null, $web->canonical);
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

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
