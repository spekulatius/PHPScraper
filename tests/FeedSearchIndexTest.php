<?php

namespace Spekulatius\PHPScraper\Tests;

use Spekulatius\PHPScraper\DataTransferObjects\FeedEntry;

class FeedSearchIndexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSearchIndexUrl()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testDefaultSearchIndexUrl()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testCustomSearchIndexUrl()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testDifferentSearchIndexUrlTypes()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

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
    public function testSearchIndexRaw()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the raw searchIndex and store it.
        $searchIndexRaw = $web->searchIndexRaw;

        // Ensure the structure is an nested array
        $this->assertTrue(is_array($searchIndexRaw));
        $this->assertTrue(is_array($searchIndexRaw[42]));

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
    public function testSearchIndex()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Get the searchIndex and store it.
        $searchIndex = $web->searchIndex;

        // Did we get the expected `/index.json`? It should contain 60 entries.
        $this->assertSame(60, count($searchIndex));

        // Check some data to ensure the parsing actually worked:
        // Set 1
        $this->assertTrue($searchIndex[4] instanceof FeedEntry);
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
        $this->assertTrue($searchIndex[2] instanceof FeedEntry);
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
        $this->assertTrue($searchIndex[0] instanceof FeedEntry);
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
