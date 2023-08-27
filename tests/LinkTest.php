<?php

namespace Spekulatius\PHPScraper\Tests;

class LinkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testNoLinks()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/no-links.html');

        // No links -> an empty array is expected.
        $this->assertSame([], $web->links);
        $this->assertSame([], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testTarget()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/target.html');

        // Check the number of links
        $this->assertSame(6, count($web->links));

        // Check the simple links list
        $this->assertSame([
            'https://placekitten.com/408/287',
            'https://placekitten.com/444/333',
            'https://placekitten.com/444/321',
            'https://placekitten.com/408/287',
            'https://placekitten.com/444/333',
            'https://placekitten.com/444/321',
        ], $web->links);

        // Check the complex links list
        $this->assertSame([
            [
                'url' => 'https://placekitten.com/408/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/333',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/321',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/408/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/333',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/321',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ],
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testRel()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        // This page contains several links with different rel attributes.
        $web->go('https://test-pages.phpscraper.de/links/rel.html');

        // Check the number of links
        $this->assertSame(5, count($web->links));

        // Check the simple links list
        $this->assertSame([
            'https://placekitten.com/432/287',
            'https://placekitten.com/456/287',
            'https://placekitten.com/345/287',
            'https://placekitten.com/345/287',
            'https://placekitten.com/345/222',
        ], $web->links);

        // Check the complex links list
        $this->assertSame([
            [
                'url' => 'https://placekitten.com/432/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow',
                'image' => [],
                'isNofollow' => true,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/456/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'ugc',
                'image' => [],
                'isNofollow' => false,
                'isUGC' => true,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow ugc',
                'image' => [],
                'isNofollow' => true,
                'isUGC' => true,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'noopener',
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => true,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/222',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'noreferrer',
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => true,
            ],
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testBaseHref()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/base-href.html');

        // Check the number of links
        $this->assertSame(3, count($web->links));

        // Check the simple links list
        $this->assertSame([
            'https://placekitten.com/408/287',
            'https://test-pages.phpscraper.de/assets/cat.jpg',
            'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
        ], $web->links);

        // Check the complex links list
        $this->assertSame([
            [
                'url' => 'https://placekitten.com/408/287',
                'protocol' => 'https',
                'text' => 'external kitten',
                'title' => 'external path with base href',
                'target' => null,
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://test-pages.phpscraper.de/assets/cat.jpg',
                'protocol' => 'https',
                'text' => 'absolute path to cat',
                'title' => 'absolute internal path with base href',
                'target' => null,
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
                'protocol' => 'https',
                'text' => 'relative cat',
                'title' => 'relative path with base href',
                'target' => null,
                'rel' => null,
                'image' => [],
                'isNofollow' => false,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ],
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testImageUrl()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/image-url.html');

        // Check the number of links
        $this->assertSame(3, count($web->links));

        // Check the complex links list
        $this->assertSame([
            [
                'url' => 'https://placekitten.com/432/500',
                'protocol' => 'https',
                'text' => '',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow',
                'image' => [
                    'https://placekitten.com/432/287',
                ],
                'isNofollow' => true,
                'isUGC' => false,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/456/500',
                'protocol' => 'https',
                'text' => '',
                'title' => null,
                'target' => null,
                'rel' => 'ugc',
                'image' => [
                    'https://placekitten.com/456/400',
                    'https://placekitten.com/456/300',
                ],
                'isNofollow' => false,
                'isUGC' => true,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/500',
                'protocol' => 'https',
                'text' => 'This is image',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow ugc',
                'image' => [
                    'https://placekitten.com/345/287',
                ],
                'isNofollow' => true,
                'isUGC' => true,
                'isSponsored' => false,
                'isMe' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ],
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testInternalLinks()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/base-href.html');

        // Check the internal links list
        $this->assertSame(
            ['https://test-pages.phpscraper.de/assets/cat.jpg'],
            $web->internalLinks
        );
    }

    /**
     * @test
     */
    public function testExternalLinks()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/links/base-href.html');

        // Check the external links list
        $this->assertSame(
            [
                'https://placekitten.com/408/287',
                'https://test-pages-with-base-href.phpscraper.de/assets/cat.jpg',
            ],
            $web->externalLinks
        );
    }
}
