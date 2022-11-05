<?php

namespace spekulatius\DataTransferObjects;

/**
 * A simplified DTO to hold feed entries with incomplete data.
 *
 * This isn't aimed at keeping all detail but the key values.
 */

class FeedEntry
{
    /**
     * @todo with drop of PHP7.4 and 8.0 we should make this `readonly`.
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $link,
    ) {
    }

    // This could be saved with a package, but this would install a lot of Laravel stuff too...
    public static function fromArray(array $data)
    {
        // Ensure the URL is absolute.


        // Convert to an object.
        return new self(
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['link'],
        );
    }
}