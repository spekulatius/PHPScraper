<?php

namespace spekulatius;

use Goutte\Client as GoutteClient;
use Symfony\Component\DomCrawler\Crawler;

trait UsesFeeds
{
    /**
     * Returns a guessed sitemap URL based on the current host.
     *
     * @return ?string
     */
    public function sitemapUrl(): ?string
    {
        // This needs to be guessed as sitemap URLs aren't fixed. Usually it's `/sitemap.xml`.
        return $this->currentHost() . '/sitemap.xml';
    }

    /**
     * Resolves the sitemap and returns an array with std objects.
     *
     * @return string $sitemap
     */
    public function sitemapRaw(): string
    {
        return $this->fetchAsset($this->sitemapUrl());
    }

    /**
     * Resolves the sitemap and returns an array with std objects.
     *
     * @todo Support for text-only, linked versions, image-sitemaps, etc.
     * @return array $sitemap
     */
    public function sitemap(): array
    {
        // See if we can parse the current URL already. If not, navigate to the guessed URL.
        $sitemap = $this->sitemapRaw();


    }


    public function searchIndexUrl(): ?string
    {
        // This is the usual location for various search indexes.
        return $this->currentHost() . '/index.json';
    }

    public function searchIndexRaw(): string
    {
        return $this->fetchAsset($this->searchIndexUrl());
    }

    public function searchIndex(): array
    {
        // See if we can parse the current URL already. If not, navigate to the usual URL.

        // https://symfony.com/doc/current/components/browser_kit.html#dealing-with-http-responses
    }


    public function rssUrls(): array
    {

    }

    public function rss(): array
    {
        // See if we can parse the current URL already. If not, navigate to the URLs.
    }

    public function feeds(): array
    {
        return [
            // Check if there is a `sitemap.xml`
            $this->sitemapUrl(),

            // Check if there is a `index.json` (static search engines)
            $this->searchIndexUrl(),

            // Add all RSS feeds we found defined.
            ...$this->rssUrls(),
        ];
    }

    public function feedsWithDetails(): array
    {
        // Check if there is a `sitemap.xml`

        // Check if there is a `index.json` (static search engines)

        // Add all RSS feeds we found defined.

    }
}