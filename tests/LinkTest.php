<?php

namespace Tests;

use TestsBaseTest;

class LinkTest extends BaseTest
{
    /**
     * @test
     */
    public function testNoLinks()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/links/no-links.html');

        // No links -> an empty array is expected.
        $this->assertSame([], $web->links);
        $this->assertSame([], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testTarget()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/links/target.html');

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
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/333',
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/321',
                'text' => 'external kitten',
                'title' => null,
                'target' => '_blank',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/408/287',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/333',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/444/321',
                'text' => 'external kitten',
                'title' => null,
                'target' => 'kitten',
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ]
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testRel()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        // This page contains a number of links with different rel attributes.
        $web->go($this->url . '/links/rel.html');

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
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow',
                'isNofollow' => true,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/456/287',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'ugc',
                'isNofollow' => false,
                'isUGC' => true,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/287',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'nofollow ugc',
                'isNofollow' => true,
                'isUGC' => true,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/287',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'noopener',
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => true,
                'isNoreferrer' => false,
            ], [
                'url' => 'https://placekitten.com/345/222',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => 'noreferrer',
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => true,
            ]
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testBaseHref()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/links/base-href.html');

        // Check the number of links
        $this->assertSame(2, count($web->links));

        // Check the simple links list
        $this->assertSame([
            'https://placekitten.com/408/287',
            $this->url . '/assets/cat.jpg',

            // Temporary deactivated, because relative paths using base_href doesn't work.
            // $this->url . '/cat.jpg',
        ], $web->links);

        // Check the complex links list
        $this->assertSame([
            [
                'url' => 'https://placekitten.com/408/287',
                'text' => 'external kitten',
                'title' => null,
                'target' => null,
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            ], [
                'url' => $this->url . '/assets/cat.jpg',
                'text' => 'absolute path to cat',
                'title' => null,
                'target' => null,
                'rel' => null,
                'isNofollow' => false,
                'isUGC' => false,
                'isNoopener' => false,
                'isNoreferrer' => false,
            // ], [
            //     'url' => $this->url . '/assets/cat.jpg',
            //     'text' => 'relative path with base href',
            //     'title' => null,
            //     'target' => null,
            //     'rel' => null,
            //     'isNofollow' => false,
            //     'isUGC' => false,
            //     'isNoopener' => false,
            //     'isNoreferrer' => false,
            ]
        ], $web->linksWithDetails);
    }

    /**
     * @test
     */
    public function testInternalLinks()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/links/base-href.html');

        // Check the internal links list
        $this->assertSame(
            [$this->url . '/assets/cat.jpg'],
            $web->internalLinks
        );
    }

    /**
     * @test
     */
    public function testExternalLinks()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/links/base-href.html');

        // Check the external links list
        $this->assertSame(
            ['https://placekitten.com/408/287'],
            $web->externalLinks
        );
    }
}
