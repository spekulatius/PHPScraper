<?php

namespace Tests;

class ParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingDownload()
    {
        $web = new \spekulatius\phpscraper;

        $this->expectException(\Symfony\Component\HttpClient\Exception\ClientException::class);
        $this->expectExceptionMessage('HTTP/2 404  returned for "https://phpscraper.de/broken-url"');

        $web->fetchAsset('https://phpscraper.de/broken-url');
    }

    /**
     * Test the various ways to call `parseJson()`.
     *
     * @test
     */
    public function testDifferentJsonCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \spekulatius\phpscraper;

        // For the reference we are using a simple JSON and parse it.
        $jsonString = $web->fetchAsset('https://test-pages.phpscraper.de/index.json');
        $jsonData = json_decode($jsonString, true);


        // Case 1: Passing in an JSON string in.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Parse the $jsonString directly.
            (new \spekulatius\phpscraper)
                ->parseJson($jsonString)
        );


        // Case 2: `go` + `parseJson()`
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Chained call using a JSON file as URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/index.json')
                ->parseJson()
        );


        // Case 3: `parseJson()` with absolute URL.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // Pass the absolutely URL to `parseJson()`
            (new \spekulatius\phpscraper)
                ->parseJson('https://test-pages.phpscraper.de/index.json')
        );


        // Case 4: `go` + `parseJson()` with relative URL.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // The 'go' sets the base URL for the following relative path.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseJson('/index.json')
        );


        // Case 5: `go` with base URL + `go` with relative URL + `parseJson()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/index.json',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/index.json')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed JSON is correct.
        $this->assertSame(
            // Pass the JSON Data as reference in.
            $jsonData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/index.json')
                ->parseJson()
        );
    }

    /**
     * @test
     */
    public function testDifferentXmlCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \spekulatius\phpscraper;

        // For the reference we are using a simple XML and parse it.
        $xmlString = $web->fetchAsset('https://test-pages.phpscraper.de/sitemap.xml');
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmlData = json_decode(json_encode($xml), true);


        // Case 1: Passing in an XML string in.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Parse the XML string directly.
            (new \spekulatius\phpscraper)
                ->parseXml($xmlString)
        );


        // Case 2: `go` + `parseXml()`
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Chained call with XML as URL
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/sitemap.xml')
                ->parseXml()
        );


        // Case 3: `parseXml()` with absolute URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Pass the absolutely URL to `parseXml()`
            (new \spekulatius\phpscraper)
                ->parseXml('https://test-pages.phpscraper.de/sitemap.xml')
        );


        // Case 4: `go` + `parseXml()` with relative URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The 'go' sets the base URL for the following relative path.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseXml('/sitemap.xml')
        );


        // Case 5: `go` with base URL + `go` with relative URL + `parseXml()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/sitemap.xml',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed JSON is correct.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->parseXml()
        );
    }



    /**
     * @test
     */
    public function testCsvDecodeRaw()
    {
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            $web->csvDecode("date,value\n1945-02-06,420\n1952-03-11,42"),
            [
                ['date', 'value'],
                ['1945-02-06', 420],
                ['1952-03-11', 42],
            ]
        );
    }

    /**
     * @test
     */
    public function testCsvDecodeWithHeaderRaw()
    {
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            $web->csvDecodeWithHeaders("date,value\n1945-02-06,420\n1952-03-11,42"),
            [
                ['date' => '1945-02-06', 'value' => 420],
                ['date' => '1952-03-11', 'value' => 42],
            ]
        );
    }

    /**
     * @test
     */
    public function testCsvParserWithConfig()
    {
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            $web->csvDecodeWithHeaders("date,value\n1945-02-06,420\n1952-03-11,42"),
            [
                ['date' => '1945-02-06', 'value' => 420],
                ['date' => '1952-03-11', 'value' => 42],
            ]
        );
    }

}
