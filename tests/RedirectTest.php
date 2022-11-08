<?php

namespace Tests;

class RedirectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testRedirect()
    {
        $web = new \spekulatius\phpscraper;

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
    public function testDisabledRedirect()
    {
        $web = new \spekulatius\phpscraper;

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
