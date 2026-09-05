<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaDescriptionTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_description()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the description as not given (null)
        $this->assertNull($web->description);
    }

    /**
     * @test
     */
    public function test_with_html_entity()
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the description
        $this->assertSame(
            'Cat & Mouse',
            $web->description
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

        // Check the description
        $this->assertSame(
            'Lorem ipsum dolor etc.',
            $web->description
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

        // Check the description
        $this->assertSame(
            'Eine deutsche Beschreibung mit Umlauten: ä ü ö',
            $web->description
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

        // Check the description
        $this->assertSame(
            'A description with Chinese Characters: 加油',
            $web->description
        );
    }
}
