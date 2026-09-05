<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\DataTransferObjects\FeedEntry;
use Spekulatius\PHPScraper\PHPScraper;

class FeedRssTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_rss_urls(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // This page shouldn't contain any RSS feeds.
        $this->assertEmpty($web->rssUrls);
    }

    /**
     * @test
     */
    public function test_rss_urls(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected result? Any URLs should be made absolute.
        $this->assertSame([
            'https://test-pages.phpscraper.de/absolute.xml',
            'https://test-pages.phpscraper.de/relative.xml',
        ], $web->rssUrls);
    }

    /**
     * Tests if we can use a custom url instead of a identified one.
     *
     * @test
     */
    public function test_custom_rss_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
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
     * We should support both absolute and relative URLs.
     *
     * @test
     */
    public function test_different_rss_url_types(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Test 1: Absolute URL
        $this->assertSame(
            $web->rssRaw($web->rssUrls[0]),
            $web->rssRaw($web->currentBaseHost . '/custom_rss.xml'),
        );

        // Test 2: Relative URL
        $this->assertSame(
            $web->rssRaw($web->rssUrls[0]),
            $web->rssRaw('/custom_rss.xml'),
        );
    }

    /**
     * Tests the raw parsing.
     *
     * @test
     */
    public function test_rss_raw_content(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // The raw RSS is rather unhandy to work with. Let's put it in a var before testing stuff.
        /** @var array<int, array{entry: array<int, array{link: array{'@attributes': array{href: string}}}>}> $rssRawFeeds */
        $rssRawFeeds = $web->rssRaw('https://test-pages.phpscraper.de/custom_rss.xml');
        $rssRaw = $rssRawFeeds[0]['entry'];

        // Check some entries to ensure the parsing works.
        $this->assertSame(
            $rssRaw[4]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/how-i-built-my-first-browser-extension/'
        );
        $this->assertSame(
            $rssRaw[2]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/how-to-use-pug-on-netlify/'
        );
        $this->assertSame(
            $rssRaw[0]['link']['@attributes']['href'],
            'https://peterthaleikis.com/posts/startup-name-check:-experiences-of-the-first-week/'
        );
    }

    /**
     * Tests the DTO creation.
     *
     * @test
     */
    public function test_rss(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // The raw RSS is rather unhandy to work with (hence we actually use the DTOs).
        $rss = $web->rss('https://test-pages.phpscraper.de/custom_rss.xml');

        // Check the count
        $this->assertSame(37, count($rss));

        // Check some entries to ensure the parsing works.
        // Set 1
        $this->assertInstanceOf(FeedEntry::class, $rss[4]);
        $this->assertSame(
            $rss[4]->title,
            'How I Built My First Browser Extension'
        );
        $this->assertSame(
            $rss[4]->link,
            'https://peterthaleikis.com/posts/how-i-built-my-first-browser-extension/'
        );

        // Set 2
        $this->assertInstanceOf(FeedEntry::class, $rss[2]);
        $this->assertSame(
            $rss[2]->title,
            'How to Use Pug on Netlify?'
        );
        $this->assertSame(
            $rss[2]->link,
            'https://peterthaleikis.com/posts/how-to-use-pug-on-netlify/'
        );

        // Set 3
        $this->assertInstanceOf(FeedEntry::class, $rss[0]);
        $this->assertSame(
            $rss[0]->title,
            'Startup Name Check: Experiences of the First week'
        );
        $this->assertSame(
            $rss[0]->link,
            'https://peterthaleikis.com/posts/startup-name-check:-experiences-of-the-first-week/'
        );
    }
}
