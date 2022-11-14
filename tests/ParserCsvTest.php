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
