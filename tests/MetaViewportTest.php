<?php

namespace Tests;

class MetaViewportTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingViewport()
    {
        $web = new \spekulatius\phpscraper();

        // Go to the test page
        $web->go($this->url . '/meta/missing.html');

        // null if there isn't a viewport set.
        $this->assertSame(null, $web->viewportString);

        // Empty array if there aren't any viewports set.
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
        $web->go($this->url . '/meta/lorem-ipsum.html');

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
