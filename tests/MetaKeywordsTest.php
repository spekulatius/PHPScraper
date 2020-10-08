<?php

namespace Tests;

class MetaKeywordTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingKeywords()
    {
        $web = new \spekulatius\phpscraper();

        // Go to the test page
        $web->go($this->url . '/meta/missing.html');

        // null if there aren't any keywords set.
        $this->assertSame(null, $web->keywordString);

        // Empty array if there aren't any keywords set.
        $this->assertTrue(is_iterable($web->keywords));
        $this->assertTrue(empty($web->keywords));
    }

    /**
     * @test
     */
    public function testNoSpaces()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/keywords/parse-no-spaces.html');

        // Check the keywords on this case...
        $this->assertSame("one,two,three", $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testSpaces()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/keywords/parse-spaces.html');

        // Check the keywords on this case...
        $this->assertSame("one, two, three", $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testIrregularSpaces()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/keywords/parse-irregular-spaces.html');

        // Check the keywords on this case...
        $this->assertSame("one, two,   three", $web->keywordString);
        $this->assertSame(['one', 'two', 'three'], $web->keywords);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/html-entities.html');

        // Check the keywords
        $this->assertSame(['Cat & Mouse', 'Mouse & Cat'], $web->keywords);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the keywords
        $this->assertSame(['Lorem', 'ipsum', 'dolor'], $web->keywords);
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/german-umlaute.html');

        // Check the keywords
        $this->assertSame(['keywords', 'schlüsselwörter'], $web->keywords);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/chinese-characters.html');

        // Check the keywords
        $this->assertSame(['加油', '貓'], $web->keywords);
    }
}
