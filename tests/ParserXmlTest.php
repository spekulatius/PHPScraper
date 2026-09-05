<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;

class ParserXmlTest extends TestCase
{
    /**
     * @test
     */
    public function test_json_parsing_context(): void
    {
        $web = new PHPScraper;

        // This tests ensures an exception is thrown, if no context is given.
        // Context means either it's been navigated before (URL context) or get something to (fetch +) parse
        try {
            $web = new PHPScraper;
            $web->parseXml();
        } catch (\Exception $e) {
            // Did we get the expected exception?
            $this->assertSame(
                'You can not call parseXml() without parameter or initial navigation.',
                $e->getMessage()
            );
        }
    }

    /**
     * @test
     */
    public function test_different_xml_calls(): void
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new PHPScraper;

        // For the reference we are using a simple XML and parse it.
        $xmlString = $web->fetchAsset('https://test-pages.phpscraper.de/sitemap.xml');
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmlData = json_decode((string) json_encode($xml), true);

        // Case 1: Passing in an XML string in.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Parse the XML string directly.
            (new PHPScraper)
                ->parseXml($xmlString)
        );

        // Case 2: `go` + `parseXml()`
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Chained call with XML as URL
            (new PHPScraper)
                ->go('https://test-pages.phpscraper.de/sitemap.xml')
                ->parseXml()
        );

        // Case 3: `parseXml()` with absolute URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // Pass the absolutely URL to `parseXml()`
            (new PHPScraper)
                ->parseXml('https://test-pages.phpscraper.de/sitemap.xml')
        );

        // Case 4: `go` + `parseXml()` with relative URL.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The 'go' sets the base URL for the following relative path.
            (new PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseXml('/sitemap.xml')
        );

        // Case 5: `go` with base URL + `go` with relative URL + `parseXml()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/sitemap.xml',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed JSON is correct.
        $this->assertSame(
            // Pass the XML Data as reference in.
            $xmlData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/sitemap.xml')
                ->parseXml()
        );
    }
}
