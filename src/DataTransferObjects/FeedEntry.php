<?php

namespace spekulatius\DataTransferObjects;

/**
 * A simplified DTO to hold feed entries with incomplete data.
 *
 * This isn't aimed at keeping all details but the key values.
 */

class FeedEntry
{
    // Support for PHP7.4
    public string $title;
    public string $description;
    public string $link;

    /**
     * @todo with drop of PHP7.4 we should make these public and remove the above.
     *
     * @todo with drop of PHP7.4 and 8.0 we should make this `readonly`.
     */
    public function __construct(
        string $title,
        string $description,
        string $link
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
    }

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