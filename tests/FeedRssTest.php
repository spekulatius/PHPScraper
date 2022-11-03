<?php

namespace Tests;

class FeedRssTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingRssUrls()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Did we get the expected `/sitemap.xml`.
        $this->assertEmpty($web->rssUrls);
    }

    /**
     * @test
     */
    public function testRssUrls()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected results. The URLs should be made absolute.
        $this->assertSame([
            'https://test-pages.phpscraper.de/absolute.xml',
            'https://test-pages.phpscraper.de/relative.xml',
        ], $web->rssUrls);
    }

    /**
     * @test
     */
    public function testCustomRssUrl()
    {
    }

    /**
     * @test
     */
    public function testRssContent()
    {
    }
}