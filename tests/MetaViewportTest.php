<?php

namespace Tests;

use spekulatius;
use PHPUnit\Framework\TestCase;

final class MetaViewportTest extends TestCase
{
    /**
     * @test
     */
    public function testMissingViewport()
    {
        $web = new \spekulatius\phpscraper();

        // Attempt to check Google
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there isn't a viewport set.
        $this->assertSame(null, $web->viewportString);

        // empty array if there aren't any viewports set.
        $this->assertTrue(is_iterable($web->viewport));
        $this->assertTrue(empty($web->viewport));
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

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
