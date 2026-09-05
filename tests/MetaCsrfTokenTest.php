<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class MetaCsrfTokenTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_csrf_token(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the csrfToken as not given (null)
        $this->assertNull($web->csrfToken);
    }

    /**
     * @test
     */
    public function test_with_csrf_token(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        // Contains: <meta name="csrf-token" content="token" />
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        // Check the csrfToken
        $this->assertSame(
            'token',
            $web->csrfToken
        );
    }
}
