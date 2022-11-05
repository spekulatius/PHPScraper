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

        // This page shouldn't contain any RSS feeds.
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

        // Did we get the expected result? Any URLs should be made absolute.
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

        // We should always allow to use a custom url.
        // Both files are the same.
        // One URL isn't linked from the feeds.html and therefore is custom.
        $this->assertSame(
            $web->rssRaw('https://test-pages.phpscraper.de/custom_rss.xml'),
            $web->rssRaw('https://test-pages.phpscraper.de/relative.xml')
        );
    }

    /**
     * Tests the raw parsing.
     *
     * @test
     */
    public function testRssRawContent()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // The raw RSS is rather unhandy to work with. Let's put it in a var before testing stuff.
        $entries = $web->rssRaw('https://test-pages.phpscraper.de/custom_rss.xml')[0]['entry'];

        // Check some entries to ensure the parsing works.
        $this->assertSame(
            $entries[4]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/how-i-built-my-first-browser-extension/'
        );
        $this->assertSame(
            $entries[2]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/how-to-use-pug-on-netlify/'
        );
        $this->assertSame(
            $entries[0]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/startup-name-check:-experiences-of-the-first-week/'
        );
    }
}