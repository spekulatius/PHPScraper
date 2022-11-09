<?php

namespace Tests;

class MetaCsrfTokenTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCsrfToken()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the csrfToken as not given (null)
        $this->assertSame(null, $web->csrfToken);
    }

    /**
     * @test
     */
    public function testWithCsrfToken()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to the test page.
        // Contains: <meta name="csrf-token" content="token" />
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the csrfToken
        $this->assertSame('token', $web->csrfToken);
    }
}
