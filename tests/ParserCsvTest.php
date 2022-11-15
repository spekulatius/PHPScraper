<?php

namespace Tests;

class ParserCsvTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testCsvDecodeRaw()
    {
        $web = new \spekulatius\phpscraper;

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
        $web = new \spekulatius\phpscraper;

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
        $web = new \spekulatius\phpscraper;

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
        $web = new \spekulatius\phpscraper;

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
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => 4.20],
                ['date' => '1952-03-11', 'value' => 42],
            ],
            $web->csvDecodeWithHeader("date,value\n1945-02-06,4.20\n1952-03-11,42"),
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
        $web = new \spekulatius\phpscraper;

        // For the reference we are using a simple CSV and parse it. This matches the hosted CSV.
        $csvString = "date,value\n1945-02-06,4.20\n1952-03-11,42";
        $csvData = [['date', 'value'], ['1945-02-06', 4.20], ['1952-03-11', 42]];


        // Case 1: Passing in an CSV string in.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Parse the $csvString directly.
            (new \spekulatius\phpscraper)
                ->parseCsv($csvString)
        );


        // Case 2: `go` + `parseCsv()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/test.csv')
                ->parseCsv()
        );


        // Case 3: `parseCsv()` with absolute URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Pass the absolutely URL to `parseCsv()`
            (new \spekulatius\phpscraper)
                ->parseCsv('https://test-pages.phpscraper.de/test.csv')
        );


        // Case 4: `go` + `parseCsv()` with relative URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The 'go' sets the base URL for the following relative path.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsv('/test.csv')
        );


        // Case 5: `go` with base URL + `go` with relative URL + `parseCsv()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/test.csv',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed CSV is correct.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->parseCsv()
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
        $web = new \spekulatius\phpscraper;

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
            (new \spekulatius\phpscraper)
                ->parseCsvWithHeader($csvString)
        );


        // Case 2: `parseCsvWithHeader()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \spekulatius\phpscraper)
                ->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv')
        );


        // Case 2: `go` + `parseCsvWithHeader()`
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Chained call using a CSV file as URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/test.csv')
                ->parseCsvWithHeader()
        );


        // Case 3: `parseCsvWithHeader()` with absolute URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // Pass the absolutely URL to `parseCsvWithHeader()`
            (new \spekulatius\phpscraper)
                ->parseCsvWithHeader('https://test-pages.phpscraper.de/test.csv')
        );


        // Case 4: `go` + `parseCsvWithHeader()` with relative URL.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The 'go' sets the base URL for the following relative path.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->parseCsvWithHeader('/test.csv')
        );


        // Case 5: `go` with base URL + `go` with relative URL + `parseCsvWithHeader()`.
        // 5.1. Ensure the final URL is correct.
        $this->assertSame(
            'https://test-pages.phpscraper.de/test.csv',

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->currentUrl()
        );

        // 5.2. Ensure the parsed CSV is correct.
        $this->assertSame(
            // Pass the CSV Data as reference in.
            $csvData,

            // The first 'go' sets the base URL for the following `go` with relative URL.
            (new \spekulatius\phpscraper)
                ->go('https://test-pages.phpscraper.de/meta/feeds.html')
                ->go('/test.csv')
                ->parseCsvWithHeader()
        );
    }
}
