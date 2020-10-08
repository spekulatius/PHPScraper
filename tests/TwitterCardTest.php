<?php

namespace Tests;

class TwitterCardTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingTwitterCard()
    {
        $web = new \spekulatius\phpscraper();

        // Go to the test page
        $web->go($this->url . '/meta/missing.html');

        // Empty array, because there aren't any twitter cards props set.
        $this->assertTrue(is_iterable($web->twitterCard));
        $this->assertTrue(empty($web->twitterCard));
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/twittercard/example.html');

        // Check elements
        $this->assertSame('summary_large_image', $web->twitterCard['twitter:card']);
        $this->assertSame('Lorem Ipsum', $web->twitterCard['twitter:title']);

        // The whole set.
        $this->assertSame(
            [
                'twitter:card' => 'summary_large_image',
                'twitter:title' => 'Lorem Ipsum',
                'twitter:description' => 'Lorem ipsum dolor etc.',
                'twitter:url' => $this->url . '/lorem-ipsum.html',
                'twitter:image' => $this->url . '/assets/cat.jpg',
            ],
            $web->twitterCard
        );
    }
}
