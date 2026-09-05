<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class HeadingTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_headings(): void
    {
        $web = new PHPScraper;

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
    public function test_with_html_entity(): void
    {
        $web = new PHPScraper;

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
    public function test_lorem_ipsum(): void
    {
        $web = new PHPScraper;

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
    public function test_german_umlaute(): void
    {
        $web = new PHPScraper;

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
    public function test_chinese_characters(): void
    {
        $web = new PHPScraper;

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
