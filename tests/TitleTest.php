<?php

namespace Tests;

class TitleTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingTitle()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the title as not given (null)
        $this->assertSame(null, $web->title);
    }

    /**
     * @test
     */
    public function testWithHTMLEntity()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/html-entities.html');

        // Check the title
        $this->assertSame('Cat & Mouse', $web->title);
    }

    /**
     * @test
     */
    public function testLoremIpsum()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the title
        $this->assertSame('Lorem Ipsum', $web->title);
    }

    /**
     * @test
     */
    public function testGermanUmlaute()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/german-umlaute.html');

        // Check the title
        $this->assertSame('A page with plenty of German umlaute everywhere (ä ü ö)', $web->title);
    }

    /**
     * @test
     */
    public function testChineseCharacters()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/chinese-characters.html');

        // Check the title
        $this->assertSame('Page with Chinese Characters all over the place (加油)', $web->title);
    }

    /**
     * @test
     */
    public function testLongTitle()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/title/long-title.html');

        // Check the title
        $this->assertSame('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mollis purus id ex consectetur facilisis. In gravida sodales nisl a consequat. Aenean ipsum sem, congue et rhoncus a, feugiat eget enim. Duis ut malesuada neque. Nam justo est, interdum eu massa in, volutpat vestibulum libero. Mauris a varius mauris, in vulputate ligula. Nulla rhoncus eget purus a sodales. Nulla facilisi. Proin purus purus, sodales non dolor in, lobortis elementum augue. Nulla sagittis, ex eu placerat varius, nulla mi rutrum odio, sit amet lacinia ipsum urna nec massa. Quisque posuere mauris id condimentum viverra.', $web->title);
    }
}
