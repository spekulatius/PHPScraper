<?php

namespace Spekulatius\PHPScraper\Tests;

class MetaViewportTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingViewport()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a viewport set.
        $this->assertNull($web->viewportString);

        // Empty array if there aren't any viewports set.
        $this->assertTrue(is_iterable($web->viewport));
        $this->assertTrue(empty($web->viewport));
    }

    /**
     * @test
     */
    public function testWithViewport()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
