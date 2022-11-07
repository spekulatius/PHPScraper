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
     * Resolves the sitemap and returns an array with raw data.
     *
     * @return array $sitemap
     */
    public function sitemapRaw(?string $url = null): array
    {
        return $this->parseXml($this->fetchAsset($url ?? $this->sitemapUrl()));
    }

    /**
     * Resolves the sitemap and returns an array of `\spekulatius\DataTransferObjects\FeedEntry`.
     *
     * @todo Support for text-only sitemaps, split versions, image-sitemaps, etc.?
     *
     * @return array $sitemap
     */
    public function sitemap(?string $url = null): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry) => DataTransferObjects\FeedEntry::fromArray([
                'title' => '',
                'description' => '',
                'link' => $entry['loc'],
            ]),

            // Fetch the sitemap URL, parse it and select the `url` section.
            $this->sitemapRaw($url)['url']
        );
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

    /**
     * Returns an array of the parsed search index JSON.
     *
     * @return array $searchIndex
     */
    public function searchIndexRaw(?string $url = null): array
    {
        return $this->parseJson($this->fetchAsset($url ?? $this->searchIndexUrl()));
    }

    /**
     * Resolves the search index and returns an array of `\spekulatius\DataTransferObjects\FeedEntry`.
     *
     * @return array $searchIndex
     */
    public function searchIndex(?string $url = null): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry) => DataTransferObjects\FeedEntry::fromArray([
                'title' => $entry['title'],
                'description' => $entry['snippet'],
                'link' => $entry['link'],
            ]),

            // Fetch the sitemap URL, parse it and select the `url` section.
            $this->searchIndexRaw($url)
        );
    }


    /**
     * Compiles a list of RSS urls based on the <link>-tags on the current page.
     */
    public function rssUrls(): array
    {
        $urls = $this->filterExtractAttributes('//link[@type="application/rss+xml"]', ['href']);

        return array_map(fn ($url) => $this->makeUrlAbsolute($url), $urls);
    }

    /**
     * Fetches a given set of RSS feeds and returns one array with raw data.
     *
     * @param ?string ...$urls
     * @return array $rss
     */
    public function rssRaw(?string ...$urls): array
    {
        return array_map(
            fn ($url) => $this->parseXml($this->fetchAsset($url)),
            empty($urls) ? $this->rssUrls() : $urls
        );
    }

    /**
     * Fetches a given set of RSS feeds and returns one array with raw data.
     *
     * @param ?string ...$urls
     * @return array $rss
     */
    public function rss(?string ...$urls): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry) => DataTransferObjects\FeedEntry::fromArray([
                'title' => $entry['title'],
                'link' => $entry['link']['@attributes']['href'],
            ]),

            // Fetch the rss URLs, parse it and select the `url` section.
            $this->rssRaw(...$urls)[0]['entry']
        );
    }


    /**
     * Merges all feeds in a unified structure. Removes duplicated URLs.
     *
     * @return array $feeds
     */
    public function feedUrls(): array
    {
        return [
            // Check the `sitemap.xml` for Urls
            $this->sitemap(),

            // Check the `index.json` (static-site search engines) for Urls
            $this->searchIndex(),

            // Add all RSS feeds we found defined.
            ...$this->rss(),
        ];
    }

    public function feedsWithDetails(): array
    {
        // Check if there is a `sitemap.xml`

        // Check if there is a `index.json` (static search engines)

        // Add all RSS feeds we found defined.
    }
}