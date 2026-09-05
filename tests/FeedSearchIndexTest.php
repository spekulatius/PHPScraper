<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\DataTransferObjects\FeedEntry;
use Spekulatius\PHPScraper\PHPScraper;

class FeedSearchIndexTest extends TestCase
{
    /**
     * @test
     */
    public function test_search_index_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/index.json`?
        $this->assertSame(
            'https://test-pages.phpscraper.de/index.json',
            $web->searchIndexUrl
        );
    }

    /**
     * Tests if the default search index path is applied.
     *
     * @test
     */
    public function test_default_search_index_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // `searchIndexUrl` should be the default.
        $this->assertSame(
            $web->searchIndexRaw(),
            $web->searchIndexRaw($web->searchIndexUrl),
        );
    }

    /**
     * The `custom_index.json` and `index.json` are the same.
     *
     * So we compare the two results to ensure the custom URL feature works.
     *
     * @test
     */
    public function test_custom_search_index_url(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // We should always allow for custom urls.
        $this->assertSame(
            $web->searchIndexRaw($web->searchIndexUrl),
            $web->searchIndexRaw($web->currentBaseHost . '/custom_index.json'),
        );
    }

    /**
     * We should support both absolute and relative URLs.
     *
     * @test
     */
    public function test_different_search_index_url_types(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Test 1: Absolute URL
        $this->assertSame(
            $web->searchIndexRaw($web->searchIndexUrl),
            $web->searchIndexRaw($web->currentBaseHost . '/custom_index.json'),
        );

        // Test 2: Relative URL
        $this->assertSame(
            $web->searchIndexRaw($web->searchIndexUrl),
            $web->searchIndexRaw('/custom_index.json'),
        );
    }

    /**
     * Tests the raw parsing.
     *
     * @test
     */
    public function test_search_index_raw(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the raw searchIndex and store it.
        /** @var array<int, array{link: string}> $searchIndexRaw */
        $searchIndexRaw = $web->searchIndexRaw;

        // Did we get the expected `/index.json`? It should contain 60 entries.
        $this->assertSame(60, count($searchIndexRaw));

        // Check some data to ensure the parsing actually worked.
        $this->assertSame(
            'https://pastablelists.com/en/counties-of-croatia',
            $searchIndexRaw[4]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/municipalities-of-macedonia',
            $searchIndexRaw[2]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-and-municipalities-of-lithuania',
            $searchIndexRaw[0]['link']
        );
    }

    /**
     * Tests the DTO creation.
     *
     * @test
     */
    public function test_search_index(): void
    {
        $web = new PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the searchIndex and store it.
        $searchIndex = $web->searchIndex;

        // Did we get the expected `/index.json`? It should contain 60 entries.
        $this->assertSame(60, count($searchIndex));

        // Check some data to ensure the parsing actually worked:
        // Set 1
        $this->assertInstanceOf(FeedEntry::class, $searchIndex[4]);
        $this->assertSame(
            'List of the Counties of Croatia',
            $searchIndex[4]->title,
        );
        $this->assertSame(
            'List of the Counties of Croatia ready for copy and paste or export.',
            $searchIndex[4]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-of-croatia',
            $searchIndex[4]->link,
        );

        // Set 2
        $this->assertInstanceOf(FeedEntry::class, $searchIndex[2]);
        $this->assertSame(
            'List of the Municipalities of Macedonia',
            $searchIndex[2]->title,
        );
        $this->assertSame(
            'List of the Municipalities of Macedonia ready for copy and paste or export.',
            $searchIndex[2]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/municipalities-of-macedonia',
            $searchIndex[2]->link,
        );

        // Set 3
        $this->assertInstanceOf(FeedEntry::class, $searchIndex[0]);
        $this->assertSame(
            'List of the Counties and Municipalities of Lithuania',
            $searchIndex[0]->title,
        );
        $this->assertSame(
            'List of the Counties and Municipalities of Lithuania, ready for copy and paste or export.',
            $searchIndex[0]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-and-municipalities-of-lithuania',
            $searchIndex[0]->link,
        );
    }
}
