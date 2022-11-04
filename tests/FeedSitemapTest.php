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
     * Tests if the default sitemap path is applied.
     *
     * @test
     */
    public function testDefaultSitemapUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertSame(
            $web->sitemap(),
            $web->sitemap($web->sitemapUrl),
        );
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

        // Did we get the expected `/sitemap.xml`.
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
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertSame(
            'https://phpscraper.de/apis/linkedin.html',
            $web->sitemap[4]['loc'],
        );
        $this->assertSame(
            'https://phpscraper.de/de/apis/zalando.html',
            $web->sitemap[20]['loc'],
        );
    }
}
