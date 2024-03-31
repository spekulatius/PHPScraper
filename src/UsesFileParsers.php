<?php

namespace Spekulatius\PHPScraper;

trait UsesFileParsers
{
    /**
     * Base Util to decode a CSV string.
     *
     * @return array $data
     */
    public function csvDecodeRaw(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        try {
            $csv = array_map(
                fn ($line) => str_getcsv($line, $separator ?? ',', $enclosure ?? '"', $escape ?? '\\'),
                explode("\n", $csvString)
            );

            // While technically 'valid', a single string isn't overly useful and likely not actually a CSV but an URL.
            if (count($csv) === 1 && count($csv[0]) === 1) {
                throw new \Exception('Does not look CSV-like');
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $csv;
    }

    /**
     * Decode CSV and cast types.
     *
     * @return array $data
     */
    public function csvDecode(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        try {
            $csv = $this->csvDecodeRaw($csvString, $separator, $enclosure, $escape);

            // Cast native and custom types
            $csv = array_map(
                fn ($line): array => array_map(
                    fn ($cell) => $this->castType($cell),
                    $line
                ),
                $csv
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $csv;
    }

    /**
     * Util to decode a CSV string to asso. array.
     *
     * @return array $data
     */
    public function csvDecodeWithHeaderRaw(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        try {
            $csv = $this->csvDecodeRaw($csvString, $separator, $enclosure, $escape);

            $header = array_shift($csv);

            // Combine the rows with the header entry.
            array_walk(
                $csv,
                function (&$row, $key, $header): void {
                    $row = array_combine($header, $row);
                },
                $header
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $csv;
    }

    /**
     * Decode a CSV string to asso. array and cast types.
     *
     * @return array $data
     */
    public function csvDecodeWithHeader(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        try {
            $csv = $this->csvDecodeWithHeaderRaw($csvString, $separator, $enclosure, $escape);

            // Cast native and custom types
            foreach ($csv as $idx => $row) {
                foreach ($row as $key => $value) {
                    $csv[$idx][$key] = $this->castType($value);
                }
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $csv;
    }

    /**
     * Helper method to cast types
     */
    public function castType(string $entry): int|float|string
    {
        // Looks like an int?
        if ($entry == (int) $entry) {
            return (int) $entry;
        }

        // Looks like a float?
        if ($entry == (float) $entry) {
            return (float) $entry;
        }

        return $entry;
    }

    /**
     * Parses a given CSV string or fetches the URL and parses it.
     *
     * @return array $data
     */
    public function parseCsv(
        ?string $csvStringOrUrl = null,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        // Check if we got either a current page or at least a URL string to process
        if ($csvStringOrUrl === null && $this->currentPage === null) {
            throw new \Exception('You can not call parseCsv() without parameter or initial navigation.');
        }

        try {
            // If we have a string, let's try to parse the CSV from this.
            if ($csvStringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = $this->csvDecode($csvStringOrUrl, $separator, $enclosure, $escape);
                } catch (\Exception $e) {
                    // We don't do anything if it fails - likely we have an URL. Let's continue below.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a CSV as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseCsv('https://...')`.
             * - `$web->go('...')->parseCsv()`.
             */
            $result = $result ?? $this->csvDecode(
                // Fetch the resource either using $csvStringOrUrl
                $this->fetchAsset(
                    // Fallback on the current URL, if needed and possible (`go` was used before).
                    $csvStringOrUrl ?? $this->currentUrl()
                ),
                $separator,
                $enclosure,
                $escape
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return (array) $result;
    }

    /**
     * Parses a given CSV string into an asso. with headers or fetches the URL and parses it.
     *
     * @return array $data
     */
    public function parseCsvWithHeader(
        ?string $csvStringOrUrl = null,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null
    ): array {
        // Check if we got either a current page or at least a URL string to process
        if ($csvStringOrUrl === null && $this->currentPage === null) {
            throw new \Exception('You can not call parseCsvWithHeader() without parameter or initial navigation.');
        }

        try {
            // If we have a string, let's try to parse the CSV from this.
            if ($csvStringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = $this->csvDecodeWithHeader($csvStringOrUrl, $separator, $enclosure, $escape);
                } catch (\Exception $e) {
                    // We don't do anything if it fails - likely we have an URL. Let's continue below.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a CSV as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseCsvWithHeader('https://...')`.
             * - `$web->go('...')->parseCsvWithHeader()`.
             */
            $result = $result ?? $this->csvDecodeWithHeader(
                // Fetch the resource either using $csvStringOrUrl
                $this->fetchAsset(
                    // Fallback on the current URL, if needed and possible (`go` was used before).
                    $csvStringOrUrl ?? $this->currentUrl()
                ),
                $separator,
                $enclosure,
                $escape
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return (array) $result;
    }

    /**
     * Parses a given JSON string or fetches the URL and parses it.
     *
     * @return array $data
     */
    public function parseJson(?string $jsonStringOrUrl = null): array
    {
        // Check if we got either a current page or at least a URL string to process
        if ($jsonStringOrUrl === null && $this->currentPage === null) {
            throw new \Exception('You can not call parseJson() without parameter or initial navigation.');
        }

        try {
            // If we have a string, let's try to parse the JSON from this.
            if ($jsonStringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = json_decode($jsonStringOrUrl, true, 512, JSON_THROW_ON_ERROR);
                } catch (\Exception $e) {
                    // We don't do anything if it fails - likely we have an URL. Let's continue below.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a JSON as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseJson('https://...')`.
             * - `$web->go('...')->parseJson()`.
             */
            $result = $result ?? json_decode(
                // Fetch the resource either using $jsonStringOrUrl
                $this->fetchAsset(
                    // Fallback on the current URL, if needed and possible (`go` was used before).
                    $jsonStringOrUrl ?? $this->currentUrl()
                ),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse JSON: ' . $e->getMessage());
        }

        return (array) $result;
    }

    /**
     * Parses a given XML string or fetches the URL and parses it.
     *
     * @return array $data
     */
    public function parseXml(?string $xmlStringOrUrl = null): array
    {
        // Check if we got either a current page or at least a URL string to process
        if ($xmlStringOrUrl === null && $this->currentPage === null) {
            throw new \Exception('You can not call parseXml() without parameter or initial navigation.');
        }

        try {
            // Try to parse the XML. If it works we have got an XML string.
            if ($xmlStringOrUrl !== null) {
                try {
                    $result = $this->xmlDecode($xmlStringOrUrl);
                } catch (\Exception $e) {
                    // Do nothing, we just want to try it if it works.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a XML as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseXml('https://...')`.
             * - `$web->go('...')->parseXml()`.
             */
            $result = $result ?? $this->xmlDecode($this->fetchAsset(
                $xmlStringOrUrl ?? $this->currentUrl()
            ));
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse XML: ' . $e->getMessage());
        }

        return $result;
    }

    protected function xmlDecode(string $xmlString): array
    {
        // XML parser
        $xml = simplexml_load_string(trim($xmlString), 'SimpleXMLElement', LIBXML_NOCDATA);

        // Convert XML to JSON and then to an associative array
        return (array) json_decode(json_encode($xml, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
