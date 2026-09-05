<?php

namespace Spekulatius\PHPScraper\DataTransferObjects;

/**
 * A simplified DTO to hold feed entries with incomplete data.
 *
 * This isn't aimed at keeping all details but the key values.
 */
class FeedEntry
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $link
    ) {}

    /**
     * @param  array<string, string>  $data
     **/
    public static function fromArray(array $data): self
    {
        // Convert to an object and return the instance.
        return new self(
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['link']
        );
    }
}
