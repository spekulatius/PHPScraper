<?php

namespace Tests;

class MetaDescriptionTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingDescription()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the description as not given (null)
        $this->assertSame(null, $web->description);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/html-entities.html');

        // Check the description
        $this->assertSame('Cat & Mouse', $web->description);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the description
        $this->assertSame("Lorem ipsum dolor etc.", $web->description);
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/german-umlaute.html');

        // Check the description
        $this->assertSame("Eine deutsche Beschreibung mit Umlauten: ä ü ö", $web->description);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/chinese-characters.html');

        // Check the description
        $this->assertSame("A description with Chinese Characters: 加油", $web->description);
    }
}
