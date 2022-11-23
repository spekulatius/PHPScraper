<?php

namespace Spekulatius\PHPScraper\Tests;

class HeadingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingHeadings()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/no-meta.html');

        // Check the missing headers (h1 actually exists on the page).
        $this->assertSame([], $web->h2);
        $this->assertSame([], $web->h3);
        $this->assertSame([], $web->h4);
        $this->assertSame([], $web->h5);
        $this->assertSame([], $web->h6);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the h1
        $this->assertSame(
            'We are testing here & elsewhere!',
            $web->h1[0]
        );

        // h2s
        $this->assertSame(2, count($web->h2));
        $this->assertSame([
            'Cat & Mouse',
            'Mouse & Cat',
        ], $web->h2);

        // Collection of headings
        $this->assertSame(
            [
                ['We are testing here & elsewhere!'],
                ['Cat & Mouse', 'Mouse & Cat'],
                ['1', '2', '3'],
                ['Not so important heading'],
                [],
                [],
            ],
            $web->headings
        );
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the h1
        $this->assertSame(
            'We are testing here!',
            $web->h1[0]
        );

        // h2s
        $this->assertSame(2, count($web->h2));
        $this->assertSame([
            'h2s are headings too.',
            'h2s are headings too.',
        ], $web->h2);
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

        // h2s
        $this->assertSame(2, count($web->h2));
        $this->assertSame([
            'Täst, ehm, test!',
            'Weiter testen, Müller!',
        ], $web->h2);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the h1
        $this->assertSame(
            'We are testing here! 加油!',
            $web->h1[0]
        );

        // h2s
        $this->assertSame(2, count($web->h2));
        $this->assertSame(['加油!', '加油 #1!'], $web->h2);
    }
}
