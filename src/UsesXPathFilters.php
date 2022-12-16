<?php

namespace Spekulatius\PHPScraper;

use Symfony\Component\DomCrawler\Crawler;

trait UsesXPathFilters
{
    /**
     * Filters the current page by a xPath-query
     *
     * @param string $query
     * @return Crawler
     */
    public function filter(string $query): Crawler
    {
        return $this->currentPage->filterXPath($query);
    }

    /**
     * Filters the current page by a xPath-query and returns the first one, or null.
     *
     * @param string $query
     * @return ?Crawler
     */
    public function filterFirst(string $query): ?Crawler
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() === 0) ? null : $filteredNodes->first();
    }

    /**
     * Filters the current page by a xPath-query and returns the first ones content, or null.
     *
     * @param string $query
     * @return ?string
     */
    public function filterFirstText(string $query): ?string
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() === 0) ? null : $filteredNodes->first()->text();
    }

    /**
     * Filters the current page by a xPath-query and returns the textual content as array.
     *
     * @param string $query
     * @return array<string>
     */
    public function filterTexts(string $query): array
    {
        return $this->filterExtractAttributes($query, ['_text']);
    }

    /**
     * Filters the current page by a xPath-query and returns the selected attributes as array.
     *
     * @param string $query
     * @param array<string> $attributes
     * @return array<string>
     */
    public function filterExtractAttributes(string $query, array $attributes): array
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() === 0) ? [] : $filteredNodes->extract($attributes);
    }

    /**
     * Filters the current page by a xPath-query and returns the selected attributes of the first match.
     *
     * @param string $query
     * @param array<string> $attributes
     * @return ?string
     */
    public function filterFirstExtractAttribute(string $query, array $attributes): ?string
    {
        $filteredNodes = $this->filter($query);

        return ($filteredNodes->count() === 0) ? null : $filteredNodes->first()->extract($attributes)[0];
    }

    /**
     * Returns the content attribute for the first result of the query, or null.
     *
     * @param string $query
     * @return ?string
     */
    public function filterFirstContent(string $query): ?string
    {
        return $this->filterFirstExtractAttribute($query, ['content']);
    }
}