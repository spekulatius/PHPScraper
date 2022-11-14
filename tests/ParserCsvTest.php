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

        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', '4.20'],
                ['1952-03-11', '42'],
            ],
            $web->csvDecodeRaw("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );
    }

    /**
     * @test
     */
    public function testCsvDecodeWithCasting()
    {
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', 4.20],
                ['1952-03-11', 42],
            ],
            $web->csvDecodeWithCasting("date,value\n1945-02-06,4.20\n1952-03-11,42"),
        );
    }

    /**
     * Test with pipe as separator, enclosure and escape.
     *
     * @test
     */
    public function testCsvDecodeWithCastingAndCustomEncoding()
    {
        $web = new \spekulatius\phpscraper;

        $this->assertSame(
            [
                ['date', 'value'],
                ['1945-02-06', 4.20],
                ['1952-03-11', 42],
                ['\\'],
            ],
            $web->csvDecodeWithCasting(
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

        $this->assertSame(
            [
                ['date' => '1945-02-06', 'value' => '4.20'],
                ['date' => '1952-03-11', 'value' => '42'],
            ],
            $web->csvDecodeWithHeaderRaw("date,value\n1945-02-06,4.20\n1952-03-11,42"),
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
}
