<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaImageTest extends TestCase
{
    /**
     * @test
     */
    public function test_call_methods_are_equal(): void
    {
        $web = new PHPScraper;

        // Attempt to my blog
        $web->go('https://peterthaleikis.com');

        // Both the method call as well as property call should return the same...
        $this->assertSame($web->image(), $web->image);
    }

    /**
     * @test
     */
    public function test_missing_image(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the absolute image path
        $this->assertNull($web->image);
    }

    /**
     * @test
     */
    public function test_absolute_path(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/image/absolute-path.html');

        // Check the absolute image path
        $this->assertSame('https://test-pages.phpscraper.de/assets/cat.jpg', $web->image);
    }

    /**
     * @test
     */
    public function test_relative_path(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/image/relative-path.html');

        // Check the relative image path should be converted into an absolute path.
        $this->assertSame(
            'https://test-pages.phpscraper.de/assets/cat.jpg',
            $web->image
        );
    }

    /**
     * @test
     */
    public function test_absolute_path_with_base_href(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/image/absolute-path-with-base-href.html');

        // Check the absolute image path
        $this->assertSame(
            'https://test-pages.phpscraper.de/assets/cat.jpg',
            $web->image
        );
    }

    /**
     * @test
     */
    public function test_relative_path_base_href(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/image/relative-path-with-base-href.html');

        // Check the relative image path
        $this->assertSame(
            'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
            $web->image
        );
    }
}
