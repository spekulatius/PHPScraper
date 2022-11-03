<?php

namespace Tests;

class FeedSitemapTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSitemapUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertSame('https://test-pages.phpscraper.de/sitemap.xml', $web->sitemapUrl);
    }

    /**
     * The files `sitemap.xml` and `custom_sitemap.xml` are the same and used to ensure the custom URL feature works.
     *
     * @test
     */
    public function testCustomSitemapUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/index.json`.
        $this->assertSame(
            $web->sitemap($web->sitemapUrl),
            $web->sitemap($web->currentBaseUrl . '/custom_sitemap.xml'),
        );
    }

    /**
     * @test
     */
    public function testSitemap()
    {
    }
}
