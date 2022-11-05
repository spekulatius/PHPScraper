<?php

namespace Tests;

class FeedSearchIndexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testSearchIndexUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/index.json`?
        $this->assertSame('https://test-pages.phpscraper.de/index.json', $web->searchIndexUrl);
    }

    /**
     * Tests if the default search index path is applied.
     *
     * @test
     */
    public function testDefaultSearchIndexUrl()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is predefined, it's only about the base URL.
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
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // We should always allow for custom urls.
        $this->assertSame(
            $web->searchIndexRaw($web->searchIndexUrl),
            $web->searchIndexRaw($web->currentBaseUrl . '/custom_index.json'),
        );
    }

    /**
     * Tests the raw parsing.
     *
     * @test
     */
    public function testSearchIndexRaw()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/index.json`? It should contain 60 entries.
        $this->assertSame(60, count($web->searchIndexRaw));

        // Check some data to ensure the parsing actually worked.
        $this->assertSame(
            'https://pastablelists.com/en/counties-of-croatia',
            $web->searchIndexRaw[4]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/municipalities-of-macedonia',
            $web->searchIndexRaw[2]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-and-municipalities-of-lithuania',
            $web->searchIndexRaw[0]['link']
        );
    }

    /**
     * Tests the DTO creation.
     *
     * @test
     */
    public function testSearchIndex()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Did we get the expected `/index.json`? It should contain 60 entries.
        $this->assertSame(60, count($web->searchIndex));

        // Check some data to ensure the parsing actually worked.
        $this->assertSame(
            'List of the Counties of Croatia',
            $web->searchIndex[4]->title,
        );
        $this->assertSame(
            'List of the Counties of Croatia ready for copy and paste or export.',
            $web->searchIndex[4]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-of-croatia',
            $web->searchIndex[4]->link,
        );

        $this->assertSame(
            'List of the Municipalities of Macedonia',
            $web->searchIndex[2]->title,
        );
        $this->assertSame(
            'List of the Municipalities of Macedonia ready for copy and paste or export.',
            $web->searchIndex[2]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/municipalities-of-macedonia',
            $web->searchIndex[2]->link,
        );

        $this->assertSame(
            'List of the Counties and Municipalities of Lithuania',
            $web->searchIndex[0]->title,
        );
        $this->assertSame(
            'List of the Counties and Municipalities of Lithuania, ready for copy and paste or export.',
            $web->searchIndex[0]->description,
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-and-municipalities-of-lithuania',
            $web->searchIndex[0]->link,
        );
    }
}