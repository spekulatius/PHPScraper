<?php

namespace Spekulatius\PHPScraper;

use Spekulatius\PHPScraper\DataTransferObjects\FeedEntry;

trait UsesFeeds
{
    /**
     * Returns a guessed sitemap URL based on the current host. Usually it's `/sitemap.xml`.
     */
    public function sitemapUrl(): string
    {
        return $this->currentBaseHost() . '/sitemap.xml';
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
     * Resolves the sitemap and returns an array of `FeedEntry`-DTOs.
     *
     * @todo Support for text-only sitemaps, split versions, image-sitemaps, etc.?
     *
     * @return array<FeedEntry> $sitemap
     */
    public function sitemap(?string $url = null): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry): FeedEntry => FeedEntry::fromArray([
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
     */
    public function searchIndexUrl(): string
    {
        return $this->currentBaseHost() . '/index.json';
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
     * Resolves the search index and returns an array of `\Spekulatius\PHPScraper\DataTransferObjects\FeedEntry`.
     *
     * @return array<FeedEntry> $searchIndex
     */
    public function searchIndex(?string $url = null): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry): FeedEntry => FeedEntry::fromArray([
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
     *
     * @return array<string>
     */
    public function rssUrls(): array
    {
        $urls = $this->filterExtractAttributes('//link[@type="application/rss+xml"]', ['href']);

        return array_map(fn ($url): string => (string) $this->makeUrlAbsolute($url), $urls);
    }

    /**
     * Fetches a given set of RSS feeds and returns one array with raw data.
     *
     * @return array $rss
     */
    public function rssRaw(?string ...$urls): array
    {
        return array_map(
            fn ($url) => $this->parseXml($this->fetchAsset((string) $url)),
            $urls === [] ? $this->rssUrls() : $urls
        );
    }

    /**
     * Fetches a given set of RSS feeds and returns one array with raw data.
     *
     * @return array<FeedEntry> $rss
     */
    public function rss(?string ...$urls): array
    {
        return array_map(
            // Create the generic DTO for each
            fn ($entry): FeedEntry => FeedEntry::fromArray([
                'title' => $entry['title'],
                'link' => $entry['link']['@attributes']['href'],
            ]),

            // Fetch the rss URLs, parse it and select the `url` section.
            $this->rssRaw(...$urls)[0]['entry']
        );
    }
}
