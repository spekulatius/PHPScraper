<?php

namespace Tests;

class FeedTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSitemapUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertSame('https://test-pages.phpscraper.de/sitemap.xml', $web->sitemapUrl);
    }

    /**
     * @test
     */
    public function testSearchIndexUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

        // Did we get the expected `/index.json`.
        $this->assertSame('https://test-pages.phpscraper.de/index.json', $web->searchIndexUrl);
    }

    /**
     * @test
     */
    public function testMissingRssUrls()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertEmpty($web->rssUrls);
    }

    // /**
    //  * @test
    //  */
    // public function testRssUrls()
    // {
    //     $web = new \spekulatius\phpscraper;

    //     // Navigate to any test page.
    //     $web->go('https://test-pages.phpscraper.de/meta/feed.html');

    //     // Did we get the expected `/sitemap.xml`.
    //     $this->assertContains([
    //         'https'
    //     ], $web->rssUrls);
    // }

    // /**
    //  * @test
    //  */
    // public function testSitemapRaw()
    // {
    //     $web = new \spekulatius\phpscraper;

    //     // Navigate to any test page.
    //     $web->go('https://test-pages.phpscraper.de/meta/meta/missing.html');

    //     // Did we get the expected `/sitemap.xml`.
    //     $this->assertSame(file_get_contents($web->sitemapUrl), $web->sitemapRaw);
    // }



}
