<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class NotFoundTest extends TestCase
{
    /**
     * @test
     */
    public function testPageMissing()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');

        // The built-in server returns this string.
        $this->assertSame('Page Not Found', $web->title);
    }
}
