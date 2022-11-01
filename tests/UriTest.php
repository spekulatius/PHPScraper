<?php

namespace Tests;

class UriTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function validateUriTest()
    {
        $web = new \spekulatius\phpscraper;

        // We use any URL for this.
        $web->go('https://test-pages.phpscraper.de/content/lists.html');

        // Ensure the URL is set correctly.
        $this->assertSame($web->currentUrl, 'https://test-pages.phpscraper.de/content/lists.html');

        // Ensure the host is parsed correctly.
        $this->assertSame($web->currentHost, 'test-pages.phpscraper.de');

        // Ensure the host with protocol is parsed correctly.
        $this->assertSame($web->currentBaseUrl, 'https://test-pages.phpscraper.de');
    }
}
