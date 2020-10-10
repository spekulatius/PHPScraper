<?php

namespace Tests;

class MetaContentTypeTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingCharset()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the contentType as not given (null)
        $this->assertSame(null, $web->contentType);
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the contentType
        $this->assertSame('text/html; charset=utf-8', $web->contentType);
    }
}
