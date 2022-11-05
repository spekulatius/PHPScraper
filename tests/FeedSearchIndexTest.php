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
}