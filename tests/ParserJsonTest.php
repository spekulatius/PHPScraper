<?php

namespace Spekulatius\PHPScraper\Tests;

class ParserJsonTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testJsonParsingContext()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // This tests ensures an exception is thrown, if no context is given.
        // Context means either it's been navigated before (URL context) or get something to (fetch +) parse
        try {
            $web = new \Spekulatius\PHPScraper\PHPScraper;
            $web->parseJson();
        } catch (\Exception $e) {
            // Did we get the expected exception?
            $this->assertSame(
                'You can not call parseJson() without parameter or initial navigation.',
                $e->getMessage()
            );
        }
    }

    /**
     * Test the various ways to call `parseJson()`.
     *
     * @test
     */
    public function testDifferentJsonCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // For the reference we are using a simple JSON and parse it.
        $jsonString = $web->fetchAsset('https://test-pages.phpscraper.de/index.json');
        $jsonData = json_decode($jsonString, true);

        // Case 1: Passing in an JSON string in.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Parse the $jsonString directly.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseJson($jsonString)
        );

        // Case 2: `go` + `parseJson()`
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Chained call using a JSON file as URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/index.json')
                ->parseJson()
        );

        // Case 3: `parseJson()` with absolute URL.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Pass the absolutely URL to `parseJson()`
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseJson('https://test-pages.phpscraper.de/index.json')
        );

        // Case 4: `go` + `parseJson()` with relative URL.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // The 'go' sets the base URL for the following relative path.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseJson('/index.json')
        );

        // Case 5: `go` with base URL + `go` with relative URL + `parseJson()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/index.json',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/index.json')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed JSON is correct.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/index.json')
                ->parseJson()
        );
    }
}
