<?php

namespace Tests;

class ImageTest extends BaseTest
{
    /**
     * @test
     */
    public function testNoImages()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // No images -> an empty array is expected.
        $this->assertSame([], $web->images);
        $this->assertSame([], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Navigate to the test page. This page contains two images (cat.jpg).
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            $this->url . '/assets/cat.jpg',
            $this->url . '/assets/cat.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/cat.jpg',
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
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/german-umlaute.html');

        // Check the h1
        $this->assertSame('We are testing here ä ü ö!', $web->h1[0]);

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            $this->url . '/assets/katze-ä-ü-ö.jpg',
            $this->url . '/assets/katze-ä-ü-ö.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => $this->url . '/assets/katze-ä-ü-ö.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/katze-ä-ü-ö.jpg',
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
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/chinese-characters.html');

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Check the simple list
        $this->assertSame([
            $this->url . '/assets/貓.jpg',
            $this->url . '/assets/貓.jpg',
        ], $web->images);

        // Check the expected data
        $this->assertSame([
            [
                'url' => $this->url . '/assets/貓.jpg',
                'alt' => 'absolute path',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/貓.jpg',
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
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/images/base-href.html');

        // Check the number of images
        $this->assertSame(2, count($web->images));

        // Current broken, due to bug in Goutte/DOMCrawler
        // Temporary deactivated, because relative paths using base_href doesn't work.
        // $this->assertSame([
        //     $this->url . '/assets/cat.jpg',
        //     $this->url . '/assets/cat.jpg',
        // ], $web->images);

        // $this->assertSame([
        //     [
        //         'url' => $this->url . '/assets/cat.jpg',
        //         'alt' => 'absolute path with base href',
        //         'width' => null,
        //         'height' => null,
        //     ],
        //     [
        //         'url' => $this->url . '/assets/cat.jpg',
        //         'alt' => 'relative path with base href',
        //         'width' => null,
        //         'height' => null,
        //     ],
        // ], $web->imagesWithDetails);
    }

    /**
     * @test
     */
    public function testWidth()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/images/width.html');

        // Check the number of images
        $this->assertSame(3, count($web->images));

        // Check the expected data
        $this->assertSame([
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'no width',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'width at 1200px',
                'width' => '1200px',
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/cat.jpg',
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
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/images/height.html');

        // Check the number of imagess
        $this->assertSame(3, count($web->images));

        // Check the expected data
        $this->assertSame([
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'no height',
                'width' => null,
                'height' => null,
            ],
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'height at 1200px',
                'width' => null,
                'height' => '1200px',
            ],
            [
                'url' => $this->url . '/assets/cat.jpg',
                'alt' => 'height at 100rem',
                'width' => null,
                'height' => '100rem',
            ],
        ], $web->imagesWithDetails);
    }
}
