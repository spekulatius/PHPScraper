<?php

namespace Tests;

class MetaCsrfTokenTest extends BaseTest
{
    /**
     * @test
     */
    public function testMissingCsrfToken()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/meta/missing.html');

        // Check the csrfToken as not given (null)
        $this->assertSame(null, $web->csrfToken);
    }

    /**
     * @test
     */
    public function testProvided()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        // Contains: <meta name="csrf-token" content="token" />
        $web->go($this->url . '/meta/lorem-ipsum.html');

        // Check the csrfToken
        $this->assertSame('token', $web->csrfToken);
    }
}
