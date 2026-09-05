<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaKeywordsTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_keywords(): void
    {
        $web = new PHPScraper;

        // Go to the test page
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // null if there aren't any keywords set.
        $this->assertNull($web->keywordString);

        // Empty array if there aren't any keywords set.
        $this->assertSame([], $web->keywords);
    }

    /**
     * @test
     */
    public function test_no_spaces(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-no-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one,two,three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_spaces(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one, two, three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_irregular_spaces(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/keywords/parse-irregular-spaces.html');

        // Check the keywords on this case...
        $this->assertSame('one, two,   three', $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_with_html_entity(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/html-entities.html');

        // Check the keywords
        $this->assertSame(['Cat & Mouse', 'Mouse & Cat'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_lorem_ipsum(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the keywords
        $this->assertSame(['Lorem', 'ipsum', 'dolor'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_german_umlaute(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/german-umlaute.html');

        // Check the keywords
        $this->assertSame(['keywords', 'schlüsselwörter'], $web->keywords);
    }

    /**
     * @test
     */
    public function test_chinese_characters(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/chinese-characters.html');

        // Check the keywords
        $this->assertSame(['加油', '貓'], $web->keywords);
    }
}
