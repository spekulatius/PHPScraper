<?php

namespace Spekulatius\PHPScraper\Tests;

class DownloadTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingDownload()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        $this->expectException(\Symfony\Component\HttpClient\Exception\ClientException::class);
        $this->expectExceptionMessage('HTTP/2 404  returned for "https://phpscraper.de/broken-url"');

        $web->fetchAsset('https://phpscraper.de/broken-url');
    }

    /**
     * @test
     */
    public function testDownload()
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $xmlString = $web->fetchAsset('https://phpscraper.de/sitemap.xml');

        // Convert XML to array
        // Credit: https://stackoverflow.com/a/20431742
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
        $array = json_decode((string) json_encode($xml), true);

        $urls = array_map(
            fn ($url) => $url['loc'],
            $array['url']
        );

        $this->assertContains(
            'https://phpscraper.de/',
            $urls
        );
    }

    /**
     * We should support both absolute and relative URLs.
     *
     * Here we use the sitemap test page as a reference.
     *
     * @test
     */
    public function testDifferentUrlTypes()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page. As the URL is predefined, it's only about the base URL.
        $web->go('https://test-pages.phpscraper.de/meta/feeds.html');

        // Test 1: Absolute URL
        $this->assertSame(
            $web->fetchAsset($web->sitemapUrl),
            $web->fetchAsset($web->currentBaseHost . '/custom_sitemap.xml'),
        );

        // Test 2: Relative URL
        $this->assertSame(
            $web->fetchAsset($web->sitemapUrl),
            $web->fetchAsset('/custom_sitemap.xml'),
        );
    }
}
