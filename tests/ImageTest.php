<?php

namespace Spekulatius\PHPScraper\Tests;

class ImageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testNoImages()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // No images -> an empty array is expected.
        $this->assertSame([], $web->images);
        $this->assertSame([], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Navigate to the test page. This page contains two images (cat.jpg).
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            'https://test-pages.phpscraper.de/assets/cat.jpg',
            'https://test-pages.phpscraper.de/assets/cat.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'relative path',
                'width' => null,
                'height' => null,
            ],
        ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

        // Check the h1
        $this->assertSame(
            'We are testing here ä ü ö!',
            $web->h1[0]
        );

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            'https://test-pages.phpscraper.de/assets/katze-ä-ü-ö.jpg',
            'https://test-pages.phpscraper.de/assets/katze-ä-ü-ö.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/katze-ä-ü-ö.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/katze-ä-ü-ö.jpg',
                'alt' => 'relative path',
                'width' => null,
                'height' => null,
            ],
        ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            'https://test-pages.phpscraper.de/assets/貓.jpg',
            'https://test-pages.phpscraper.de/assets/貓.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/貓.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/貓.jpg',
                'alt' => 'relative path',
                'width' => null,
                'height' => null,
            ],
        ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testBaseHref()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/images/base-href.html');

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Base set:
        $this->assertSame([
            'https://test-pages.phpscraper.de/assets/cat.jpg',
            'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
        ], $web->images);

        // Detail set:
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'absolute path with base href',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
                'alt' => 'relative path with base href',
                'width' => null,
                'height' => null,
            ],
        ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testWidth()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/images/width.html');

        // Check the number of images
        $this->assertSame(3, count($web->images));

        // Check the expected data
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'no width',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'width at 1200px',
                'width' => '1200px',
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'width at 100rem',
                'width' => '100rem',
                'height' => null,
            ],
        ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testHeight()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/images/height.html');

        // Check the number of imagess
        $this->assertSame(3, count($web->images));

        // Check the expected data
        $this->assertSame([
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'no height',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'height at 1200px',
                'width' => null,
                'height' => '1200px',
            ],
            [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'alt' => 'height at 100rem',
                'width' => null,
                'height' => '100rem',
            ],
        ], $web->imagesWithDetails);
    }
}
