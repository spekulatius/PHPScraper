<?php

namespace Spekulatius\PHPScraper\Tests;

use PHPUnit\Framework\TestCase;
use Spekulatius\PHPScraper\PHPScraper;
use Symfony\Component\HttpClient\Exception\ClientException;

class DownloadTest extends TestCase
{
    /**
     * @test
     */
    public function test_missing_download(): void
    {
        $web = new PHPScraper;

        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('HTTP/2 404  returned for "https://phpscraper.de/broken-url"');

        $web->fetchAsset('https://phpscraper.de/broken-url');
    }

    /**
     * @test
     */
    public function test_download(): void
    {
        // Downloads the PHPScraper sitemap and ensures the homepage is included (valid download and output).
        $web = new PHPScraper;
        $xmlString = $web->fetchAsset('https://phpscraper.de/sitemap.xml');

        // Convert XML to array
        // Credit: https://stackoverflow.com/a/20431742
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);

        /** @var array{url: array<int, array{loc: string}>} $array */
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
    public function test_different_url_types(): void
    {
        $web = new PHPScraper;

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
