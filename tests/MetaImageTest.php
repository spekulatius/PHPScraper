<?php

namespace Tests;

class MetaImageTest extends BaseTest
{
    /**
     * @test
     */
    public function testCallMethodsAreEqual()
    {
        $web = new \spekulatius\phpscraper();

        // Attempt to my blog
        $web->go('https://peterthaleikis.com');

        // Both the method call as well as property call should return the same...
        $this->assertSame($web->image(), $web->image);
    }

    /**
     * @test
     */
    public function testMissingImage()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the absolute image path
        $this->assertSame(null, $web->image);
    }

    /**
     * @test
     */
    public function testAbsolutePath()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/image/absolute-path.html');

        // Check the absolute image path
        $this->assertSame("$this->url/assets/cat.jpg", $web->image);
    }

    // /**
    //  * @test
    //  */
    // public function testRelativePath()
    // {
    //     $web = new \spekulatius\phpscraper();

    //     // Navigate to the test page.
    //     $web->go($this->url . '/meta/image/relative-path.html');

    //     // Check the relative image path
    //     $this->assertSame("$this->url/assets/cat.jpg", $web->image);
    // }

    // /**
    //  * @test
    //  */
    // public function testAbsolutePathWithBaseHref()
    // {
    //     $web = new \spekulatius\phpscraper();

    //     // Navigate to the test page.
    //     $web->go($this->url . '/meta/image/absolute-path-with-base-href.html');
    //     $this->assertNotSame("Page Not Found", $web->title);

    //     // Check the absolute image path
    //     $this->assertSame("$this->url/assets/cat.jpg", $web->image);
    // }

    // /**
    //  * @test
    //  */
    // public function testRelativePathBaseHref()
    // {
    //     $web = new \spekulatius\phpscraper();

    //     // Navigate to the test page.
    //     $web->go($this->url . '/meta/image/relative-path-with-base-href.html');
    //     $this->assertNotSame("Page Not Found", $web->title);

    //     // Check the relative image path
    //     $this->assertSame("$this->url/assets/cat.jpg", $web->image);
    // }
}
