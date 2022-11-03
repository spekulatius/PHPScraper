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
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Did we get the expected `/index.json`.
        $this->assertSame('https://test-pages.phpscraper.de/index.json', $web->searchIndexUrl);
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
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Did we get the expected `/index.json`.
        $this->assertSame(
            $web->searchIndex($web->searchIndexUrl),
            $web->searchIndex($web->currentBaseUrl . '/custom_index.json'),
        );
    }

    /**
     * @test
     */
    public function testSearchIndex()
    {
        $web = new \spekulatius\phpscraper;

        // Navigate to any test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Did we get the expected `/sitemap.xml`? It should be sitemap.xml as provided by the the url method.
        $this->assertSame(60, count($web->searchIndex));

        // Check some data to ensure the parsing actually worked.
        $this->assertSame(
            'https://pastablelists.com/en/counties-of-croatia',
            $web->searchIndex[4]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/municipalities-of-macedonia',
            $web->searchIndex[2]['link']
        );
        $this->assertSame(
            'https://pastablelists.com/en/counties-and-municipalities-of-lithuania',
            $web->searchIndex[0]['link']
        );
    }
}