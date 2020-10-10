<?php

namespace Tests;

class MetaCharsetTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingCharset()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the charset as not given (null)
        $this->assertSame(null, $web->charset);
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the charset
        $this->assertSame('utf-8', $web->charset);
    }
}
