<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class NotFoundTest extends TestCase
{
    /**
     * @test
     */
    public function test_page_missing()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');

        // The built-in server returns this string.
        $this->assertSame('Page not found', $web->title);
    }
}
