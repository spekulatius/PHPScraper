<?php

namespace Tests;

class OpenGraphTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingOpenGraph()
    {
        $web = new \spekulatius\phpscraper();

        // Go to the test page
        $web->go($this->url . '/meta/missing.html');

        // Empty array, because there aren't any open graph props set.
        $this->assertTrue(is_iterable($web->openGraph));
        $this->assertTrue(empty($web->openGraph));
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/og/example.html');

        // Check elements
        $this->assertSame('Lorem Ipsum', $web->openGraph['og:title']);
        $this->assertSame('Lorem ipsum dolor etc.', $web->openGraph['og:description']);

        // The whole set.
        $this->assertSame(
            [
                'og:site_name' => 'Lorem ipsum',
                'og:type' => 'website',
                'og:title' => 'Lorem Ipsum',
                'og:description' => 'Lorem ipsum dolor etc.',
                'og:url' => $this->url . '/lorem-ipsum.html',
                'og:image' => $this->url . '/assets/cat.jpg',
            ],
            $web->openGraph
        );
    }
}
