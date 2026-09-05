<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaContentTypeTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_content_type(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the contentType as not given (null)
        $this->assertNull($web->contentType);
    }

    /**
     * @test
     */
    public function test_with_content_type(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the contentType
        $this->assertSame(
            'text/html; charset=utf-8',
            $web->contentType
        );
    }
}
