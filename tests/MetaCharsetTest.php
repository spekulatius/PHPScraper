<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaCharsetTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_charset(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the charset as not given (null)
        $this->assertNull($web->charset);
    }

    /**
     * @test
     */
    public function test_with_charset(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the charset
        $this->assertSame(
            'utf-8',
            $web->charset
        );
    }
}
