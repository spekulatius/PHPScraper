<?php

namespace Tests;

use spekulatius;
use PHPUnit\Framework\TestCase;

final class TwitterCardTest extends TestCase
{
    /**
     * @test
     */
    public function testMissingTwitterCard()
    {
        $web = new \spekulatius\phpscraper();

        // Attempt to check Google
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

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
        $web->go('https://test-pages.phpscraper.de/twittercard/example.html');

        // Check elements
        $this->assertSame('summary_large_image', $web->twitterCard['twitter:card']);
        $this->assertSame('Lorem Ipsum', $web->twitterCard['twitter:title']);

        // the whole set.
        $this->assertSame(
            [
                'twitter:card' => 'summary_large_image',
                'twitter:title' => 'Lorem Ipsum',
                'twitter:description' => 'Lorem ipsum dolor etc.',
                'twitter:url' => 'https://test-pages.phpscraper.de/lorem-ipsum.html',
                'twitter:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
            ],
            $web->twitterCard
        );
    }
}
