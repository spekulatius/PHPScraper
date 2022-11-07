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

        // Did we get the expected `/sitemap.xml`?
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

        // The sitemapUrl should be the default.
        $this->assertSame(
            $web->sitemapRaw(),
            $web->sitemapRaw($web->sitemapUrl),
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

        // We should always allow for custom paths.
        $this->assertSame(
            $web->sitemapRaw($web->sitemapUrl),
            $web->sitemapRaw($web->currentBaseUrl . '/custom_sitemap.xml'),
        );
    }

    /**
     * @test
     */
    public function testSitemapRaw()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Check the count
        $this->assertSame(129, count($web->sitemapRaw['url']));

        // Check some entries to ensure the parsing works as expected.
        $this->assertSame(
            'https://phpscraper.de/apis/linkedin.html',
            $web->sitemapRaw['url'][4]['loc'],
        );
        $this->assertSame(
            'https://phpscraper.de/de/apis/zalando.html',
            $web->sitemapRaw['url'][20]['loc'],
        );
    }

    /**
     * Tests the DTO creation.
     *
     * @test
     */
    public function testSitemap()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Check the count
        $this->assertSame(129, count($web->sitemap));

        // Check some samples.
        $this->assertSame(
            'https://phpscraper.de/apis/linkedin.html',
            $web->sitemap[4]->link,
        );
        $this->assertSame(
            'https://phpscraper.de/de/apis/zalando.html',
            $web->sitemap[20]->link
        );
    }
}