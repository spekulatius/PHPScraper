<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class RedirectTest extends TestCase
{
    /**
     * @test
     */
    public function test_redirect()
    {
        $web = new PHPScraper;

        // Navigate to the test page: This redirects to phpscraper.de
        $web->go('https://test-pages.phpscraper.de');

        $this->assertNotSame(
            $web->currentUrl,
            'https://test-pages.phpscraper.de/'
        );
        $this->assertSame(
            $web->currentUrl,
            'https://phpscraper.de/'
        );
    }

    /**
     * @test
     */
    public function test_disabled_redirect()
    {
        $web = new PHPScraper;

        $web->setConfig([
            'follow_redirects' => false,
            'follow_meta_refresh' => false,
            'max_redirects' => -1,
        ]);

        // Navigate to the test page: This redirects to phpscraper.de
        $web->go('https://test-pages.phpscraper.de');

        $this->assertSame(
            'https://test-pages.phpscraper.de',
            $web->currentUrl,
        );
    }
}
