<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;

class NotFoundTest extends TestCase
{
    /**
     * @test
     */
    public function testPageMissing()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');

        // The built-in server returns this string.
        $this->assertSame('Page Not Found', $web->title);
    }
}
