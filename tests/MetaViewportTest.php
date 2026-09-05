<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaViewportTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_viewport(): void
    {
        $web = new PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a viewport set.
        $this->assertNull($web->viewportString);

        // Empty array if there aren't any viewports set.
        $this->assertSame([], $web->viewport);
    }

    /**
     * @test
     */
    public function test_with_viewport(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the viewport
        $this->assertSame(
            'width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no',
            $web->viewportString
        );
        $this->assertSame(
            ['width=device-width', 'initial-scale=1', 'shrink-to-fit=no', 'maximum-scale=1', 'user-scalable=no'],
            $web->viewport
        );
    }
}
