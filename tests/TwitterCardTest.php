<?php

namespace Spekulatius\PHPScraper\Tests;

class TwitterCardTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingTwitterCard()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Empty array, because there aren't any twitter cards props set.
        $this->assertTrue(is_iterable($web->twitterCard));
        $this->assertTrue(empty($web->twitterCard));
    }

    /**
     * @test
     */
    public function testTwitterCard()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/twittercard/example.html');

        // Check elements
        $this->assertSame('summary_large_image', $web->twitterCard['twitter:card']);
        $this->assertSame('Lorem Ipsum', $web->twitterCard['twitter:title']);

        // The whole set.
        $this->assertSame(
            [
                'twitter:card' => 'summary_large_image',
                'twitter:title' => 'Lorem Ipsum',
                'twitter:description' => 'Lorem ipsum dolor etc.',
                'twitter:url' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
                'twitter:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
            ],
            $web->twitterCard
        );
    }
}
