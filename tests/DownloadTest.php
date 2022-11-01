<?php

namespace Tests;

class DownloadTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testDownload()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \spekulatius\phpscraper;
        $xmlString = $web->fetchAsset('https://phpscraper.de/sitemap.xml');

        // Convert XML to array
        // Credit: https://stackoverflow.com/a/20431742
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        $urls = array_map(
            fn ($url) => $url['loc'],
            $array['url']
        );

        $this->assertContains('https://phpscraper.de/', $urls);
    }

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
}
