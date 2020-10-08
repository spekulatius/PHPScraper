<?php

namespace Tests;

use Tests\BaseTest;

class CanonicalTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingCanonical()
    {
        $web = new \spekulatius\phpscraper();

        // Go to the test page
        $web->go($this->url . '/meta/missing.html');

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
        // It contains: <link rel="canonical" href="http://localhost:8089/navigation/2.html" />
        $web->go($this->url . '/navigation/1.html');

        // Check the canonical
        $this->assertSame(
            $this->url . '/navigation/2.html',
            $web->canonical
        );
    }
}
