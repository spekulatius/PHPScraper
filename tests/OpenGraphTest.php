<?php

namespace Tests;

use spekulatius;
use PHPUnit\Framework\TestCase;

final class OpenGraphTest extends TestCase
{
    /**
     * @test
     */
    public function testMissingOpenGraph()
    {
        $web = new \spekulatius\phpscraper();

        // Attempt to check Google
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

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
        $web->go('https://test-pages.phpscraper.de/og/example.html');

        // Check elements
        $this->assertSame('Lorem Ipsum', $web->openGraph['og:title']);
        $this->assertSame('Lorem ipsum dolor etc.', $web->openGraph['og:description']);

        // the whole set.
        $this->assertSame(
            [
                'og:site_name' => 'Lorem ipsum',
                'og:type' => 'website',
                'og:title' => 'Lorem Ipsum',
                'og:description' => 'Lorem ipsum dolor etc.',
                'og:url' => 'https://test-pages.phpscraper.de/lorem-ipsum.html',
                'og:image' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
            ],
            $web->openGraph
        );
    }
}
