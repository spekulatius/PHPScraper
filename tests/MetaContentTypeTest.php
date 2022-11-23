<?php

namespace Spekulatius\PHPScraper\Tests;

class MetaContentTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCharset()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the contentType as not given (null)
        $this->assertNull($web->contentType);
    }

    /**
     * @test
     */
    public function testWithCharset()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the contentType
        $this->assertSame(
            'text/html; charset=utf-8',
            $web->contentType
        );
    }
}
