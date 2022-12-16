<?php

namespace Spekulatius\PHPScraper\Tests;

class MetaCharsetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCharset()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the charset as not given (null)
        $this->assertNull($web->charset);
    }

    /**
     * @test
     */
    public function testWithCharset()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the charset
        $this->assertSame(
            'utf-8',
            $web->charset
        );
    }
}
