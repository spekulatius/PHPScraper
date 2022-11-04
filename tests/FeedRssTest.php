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
     * Tests if we can use a custom url instead of a provided one.
     *
     * @test
     */
    public function testCustomRssUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Both files are the same. One URL isn't linked from the feeds.html and therefore is custom.
        $this->assertSame(
            $web->rss('https://test-pages.phpscraper.de/custom_rss.xml'),
            $web->rss('https://test-pages.phpscraper.de/relative.xml')
        );
    }

    /**
     * @test
     */
    public function testRssContent()
    {
    }
}