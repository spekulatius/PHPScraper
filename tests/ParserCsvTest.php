<?php

namespace Spekulatius\PHPScraper\Tests;

class ParserCsvTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testCsvParsingContext()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // This tests ensures an exception is thrown, if no context is given.
        // Context means either it's been navigated before (URL context) or get something to (fetch +) parse
        try {
            $web = new \Spekulatius\PHPScraper\PHPScraper;
            $web->parseCsv();
        } catch (\Exception $e) {
            // Did we get the expected exception?
            $this->assertSame(
                'You can not call parseCsv() without parameter or initial navigation.',
                $e->getMessage()
            );
        }

        // This tests ensures an exception is thrown, if no context is given.
        // Context means either it's been navigated before (URL context) or get something to (fetch +) parse
        try {
            $web = new \Spekulatius\PHPScraper\PHPScraper;
            $web->parseCsvWithHeader();
        } catch (\Exception $e) {
            // Did we get the expected exception?
            $this->assertSame(
                'You can not call parseCsvWithHeader() without parameter or initial navigation.',
                $e->getMessage()
            );
        }
    }

    /**
     * @test
     */
    public function testCsvDecodeRaw()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Only decoding
        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', '4.20'],
                ['1952-03-11', '42'],
            ],
            $web->csvDecodeRaw("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );

        // Fetching and decoding
        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', '4.20'],
                ['1952-03-11', '42'],
            ],
            $web->csvDecodeRaw($web->fetchAsset('https://test-pages.phpscraper.de/test.csv')),
        );
    }

    /**
     * @test
     */
    public function testCsvDecode()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Only decoding
        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', 4.20],
                ['1952-03-11', 42],
            ],
            $web->csvDecode("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );

        // Fetching and decoding
        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', 4.20],
                ['1952-03-11', 42],
            ],
            $web->csvDecode($web->fetchAsset('https://test-pages.phpscraper.de/test.csv')),
        );
    }

    /**
     * Test with pipe as separator, enclosure and escape.
     *
     * @test
     */
    public function testCsvDecodeAndCustomEncoding()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', 4.20],
                ['1952-03-11', 42],
                ['\\'],
            ],
            $web->csvDecode(
                "\"date\"|\"value\"\n\"1945-02-06\"|\"4.20\"\n\"1952-03-11\"|\"42\"\n\\",
                '|',
                '"',
                '\\'
            )
        );
    }

    /**
     * @test
     */
    public function testCsvDecodeWithHeaderRaw()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Only decoding
        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => '4.20'],
                ['date' => '1952-03-11', 'value' => '42'],
            ],
            $web->csvDecodeWithHeaderRaw("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );

        // Fetching and decoding
        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => '4.20'],
                ['date' => '1952-03-11', 'value' => '42'],
            ],
            $web->csvDecodeWithHeaderRaw($web->fetchAsset('https://test-pages.phpscraper.de/test.csv')),
        );
    }

    /**
     * @test
     */
    public function testCsvDecodeWithHeaderAndCasting()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => 4.20],
                ['date' => '1952-03-11', 'value' => 42],
            ],
            $web->csvDecodeWithHeader("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );
    }

    /**
     * Test with header, pipe as separator, and enclosure.
     *
     * @test
     */
    public function testCsvDecodeWithHeaderAndCustomEncoding()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => 4.20],
                ['date' => '1952-03-11', 'value' => 42],
            ],

            $web->csvDecodeWithHeader(
                "\"date\"|\"value\"\n\"1945-02-06\"|\"4.20\"\n\"1952-03-11\"|\"42\"",
                '|',
                '"',
                '\\'
            )
        );
    }

    /**
     * Check the pluming: Test the various ways to call `parseCsv()`.
     *
     * @test
     */
    public function testDifferentCsvCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // For the reference we are using a simple CSV and parse it. This matches the hosted CSV.
        $csvString = "date,value\n1945-02-06,4.20\n1952-03-11,42";
        $csvData = [['date', 'value'], ['1945-02-06', 4.20], ['1952-03-11', 42]];

        // Case 1: Passing in an CSV string in.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Parse the $csvString directly.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseCsv($csvString)
        );

        // Case 2: `go` + `parseCsv()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/test.csv')
                ->parseCsv()
        );

        // Case 3: `parseCsv()` with absolute URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Pass the absolutely URL to `parseCsv()`
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseCsv('https://test-pages.phpscraper.de/test.csv')
        );

        // Case 4: `go` + `parseCsv()` with relative URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The 'go' sets the base URL for the following relative path.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsv('/test.csv')
        );

        // Case 5: `go` with base URL + `go` with relative URL + `parseCsv()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/test.csv',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed CSV is correct.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->parseCsv()
        );

        // Case 6: With encoding params
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test-custom.csv')
                ->parseCsv(null, '|', '"')
        );

        // Case 7: With encoding params and (relative) URL
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsv('/test-custom.csv', '|', '"')
        );
    }

    /**
     * Check the pluming: Test the various ways to call `parseCsvWithHeader()`.
     *
     * @test
     */
    public function testDifferentCsvWithHeaderCalls()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // For the reference we are using a simple CSV and parse it. This matches the hosted CSV.
        $csvString = "date,value\n1945-02-06,4.20\n1952-03-11,42";
        $csvData = [
            ['date' => '1945-02-06', 'value' => 4.20],
            ['date' => '1952-03-11', 'value' => 42],
        ];

        // Case 1: Passing in an CSV string in.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Parse the $csvString directly.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseCsvWithHeader($csvString)
        );

        // Case 2: `parseCsvWithHeader()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv')
        );

        // Case 2: `go` + `parseCsvWithHeader()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/test.csv')
                ->parseCsvWithHeader()
        );

        // Case 3: `parseCsvWithHeader()` with absolute URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Pass the absolutely URL to `parseCsvWithHeader()`
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv')
        );

        // Case 4: `go` + `parseCsvWithHeader()` with relative URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The 'go' sets the base URL for the following relative path.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsvWithHeader('/test.csv')
        );

        // Case 5: `go` with base URL + `go` with relative URL + `parseCsvWithHeader()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/test.csv',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed CSV is correct.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->parseCsvWithHeader()
        );

        // Case 6: With encoding params
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test-custom.csv')
                ->parseCsvWithHeader(null, '|', '"')
        );

        // Case 7: With encoding params and (relative) URL
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \Spekulatius\PHPScraper\PHPScraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsvWithHeader('/test-custom.csv', '|', '"')
        );
    }
}
