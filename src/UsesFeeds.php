<?php

namespace spekulatius;

trait UsesFeeds
{
    /**
     * Returns a guessed sitemap URL based on the current host. Usually it's `/sitemap.xml`.
     *
     * @todo implement actual checks if the URL exists.
     *
     * @return ?string
     */
    public function sitemapUrl(): ?string
    {
        return $this->currentBaseUrl() . '/sitemap.xml';
    }

    /**
     * Resolves the sitemap and returns an array.
     *
     * @todo Support for text-only sitemaps, split versions, image-sitemaps, etc.
     *
     * @return array $sitemap
     */
    public function sitemap(?string $url = null): array
    {
        return $this->parseXml($this->fetchAsset($url ?? $this->sitemapUrl()));
    }


    /**
     * Returns the usual location (URL) for the static search index.
     *
     * @todo implement actual checks if the URL exists.
     *
     * @return ?string
     */
    public function searchIndexUrl(): ?string
    {
        return $this->currentBaseUrl() . '/index.json';
    }

    public function searchIndex(?string $url = null): array
    {
        return $this->parseJson($this->fetchAsset($url ?? $this->searchIndexUrl()));
    }




    /**
     * Compiles a list of RSS urls based on the <link>-tags on the current page.
     */
    public function rssUrls(): array
    {
        $urls = $this->filterExtractAttributes('//link[@type="application/rss+xml"]', ['href']);

        return array_map(fn ($url) => $this->makeUrlAbsolute($url), $urls);
    }

    public function rss(?string $url): array
    {
        // See if we can parse the current URL already. If not, navigate to the URLs.
        return $this->parseXML($this->rssRaw());
    }




    /**
     * Merges all feeds in a unified structure. Removes duplicated URLs.
     *
     * @return array $feeds
     */
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