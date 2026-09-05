<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\DataTransferObjects\FeedEntry;
use Spekulatius\PHPScraper\PHPScraper;

class FeedSitemapTest extends TestCase
{
    /**
     * @test
     */
    public function test_sitemap_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/sitemap.xml`?
        $this->assertSame(
            'https://test-pages.phpscraper.de/sitemap.xml',
            $web->sitemapUrl
        );
    }

    /**
     * Tests if the default sitemap path is applied.
     *
     * @test
     */
    public function test_default_sitemap_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is guessed, it's only about the base URL.
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
    public function test_custom_sitemap_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // We should always allow for custom paths.
        $this->assertSame(
            $web->sitemapRaw($web->sitemapUrl),
            $web->sitemapRaw($web->currentBaseHost . '/custom_sitemap.xml'),
        );
    }

    /**
     * We should support both absolute and relative URLs.
     *
     * @test
     */
    public function test_different_sitemap_url_types(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Test 1: Absolute URL
        $this->assertSame(
            $web->sitemapRaw($web->sitemapUrl),
            $web->sitemapRaw($web->currentBaseHost . '/custom_sitemap.xml'),
        );

        // Test 2: Relative URL
        $this->assertSame(
            $web->sitemapRaw($web->sitemapUrl),
            $web->sitemapRaw('/custom_sitemap.xml'),
        );
    }

    /**
     * Ensure we can parse the sitemap in itself (XML).
     *
     * @test
     */
    public function test_sitemap_raw(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the sitemap and store it.
        /** @var array{url: array<int, array{loc: string}>} $sitemapRaw */
        $sitemapRaw = $web->sitemapRaw;

        // Check the count
        $this->assertSame(129, count($sitemapRaw['url']));

        // Check some entries to ensure the parsing works as expected.
        $this->assertSame(
            'https://phpscraper.de/apis/linkedin.html',
            $sitemapRaw['url'][4]['loc'],
        );
        $this->assertSame(
            'https://phpscraper.de/de/apis/zalando.html',
            $sitemapRaw['url'][20]['loc'],
        );
    }

    /**
     * Tests the DTO creation.
     *
     * @test
     */
    public function test_sitemap(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is guessed, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the sitemap and store it.
        $sitemap = $web->sitemap;

        // Check the count
        $this->assertSame(129, count($sitemap));

        // Check some samples.
        $this->assertInstanceOf(FeedEntry::class, $sitemap[42]);
        $this->assertSame(
            'https://phpscraper.de/apis/linkedin.html',
            $sitemap[4]->link,
        );
        $this->assertSame(
            'https://phpscraper.de/de/apis/zalando.html',
            $sitemap[20]->link
        );
    }
}
