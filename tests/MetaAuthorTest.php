<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaAuthorTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_author()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

        // Check the author as not given (null)
        $this->assertNull($web->author);
    }

    /**
     * @test
     */
    public function test_with_html_entity()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the author
        $this->assertSame(
            'Cat & Mouse',
            $web->author
        );
    }

    /**
     * @test
     */
    public function test_lorem_ipsum()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the author
        $this->assertSame(
            'Lorem ipsum',
            $web->author
        );
    }

    /**
     * @test
     */
    public function test_german_umlaute()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

        // Check the author
        $this->assertSame(
            'Müller',
            $web->author
        );
    }

    /**
     * @test
     */
    public function test_chinese_characters()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the author
        $this->assertSame(
            '貓',
            $web->author
        );
    }
}
