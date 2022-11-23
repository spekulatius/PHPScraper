<?php

namespace Spekulatius\PHPScraper\Tests;

class ParserXmlTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testDifferentXmlCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // For the reference we are using a simple XML and parse it.
        $xmlString = $web->fetchAsset('https://test-pages.phpscraper.de/sitemap.xml');
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmlData = json_decode(json_encode($xml), true);


        // Case 1: Passing in an XML string in.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Parse the XML string directly.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseXml($xmlString)
        );


        // Case 2: `go` + `parseXml()`
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Chained call with XML as URL
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/sitemap.xml')
                ->parseXml()
        );


        // Case 3: `parseXml()` with absolute URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Pass the absolutely URL to `parseXml()`
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseXml('https://test-pages.phpscraper.de/sitemap.xml')
        );


        // Case 4: `go` + `parseXml()` with relative URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The 'go' sets the base URL for the following relative path.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseXml('/sitemap.xml')
        );


        // Case 5: `go` with base URL + `go` with relative URL + `parseXml()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/sitemap.xml',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed JSON is correct.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->parseXml()
        );
    }
}
