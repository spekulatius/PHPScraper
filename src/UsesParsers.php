<?php

namespace spekulatius;

trait UsesParsers
{
    /**
     * Base Util to decode CSVs.
     *
     * @param string $csvString
     * @param ?string $separator
     * @param ?string $enclosure
     * @param ?string $escape
     * @return array $data
     */
    public function csvDecodeRaw(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null,
    ): array {
        try {
            $array = array_map(
                fn($line) => str_getcsv($line, $separator, $enclosure, $escape),
                explode("\n", $csvString)
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $array;
    }

    /**
     * Decode CSV and cast types.
     *
     * @param string $csvString
     * @param ?string $separator
     * @param ?string $enclosure
     * @param ?string $escape
     * @return array $data
     */
    public function csvDecodeWithCasting(
        string $csvString,
        ?string $separator = null,
        ?string $enclosure = null,
        ?string $escape = null,
    ): array {
        try {
            $array = $this->csvDecodeRaw($csvString, $separator, $enclosure, $escape);

            // Cast native and custom types
            $array = array_map(
                fn ($line) => array_map(
                    fn ($cell) => $this->castType($cell),
                    $line
                ),
                $array
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $array;
    }

    // Helper method to cast types
    protected function castType(string $entry)
    {
        if ($entry == (int) $entry) {
            return (int) $entry;
        }

        if ($entry == (float) $entry) {
            return (float) $entry;
        }

        return $entry;
    }

















    public function csvDecodeWithHeaderRaw(
        string $csvString,
        ?array $options = []
    ): array {
        // merge options with the configuration and the global defaults
        // $config = array_merge(
        //     $this->config

        // );

        $array = [];

        try {
            $array = $this->csvDecodeRaw($csvString);

            $header = array_shift($array);

            array_walk(
                $array,
                function(&$row, $key, $header) {
                    $row = array_combine($header, $row);
                },
                $header
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $array;
    }

    public function csvDecodeWithHeader(
        string $csvString,
        ?array $options = []
    ): array {
        $csv = $this->csvDecodeWithHeaderRaw($csvString, $options);

        // Cast some common types?
        if ($config['enableCastTyping']) {
            //

            // Custom types? Callbacks anyone?
            foreach ($config['customTypes'] as $field => $callback) {
                // check if the field matches.
                $entry = $callback($entry);
            }
        }

        return $csv;
    }




    /**
     * A boilerplate function to process the various calling options for `parseX` functions.
     */
    public function parseResource(
        ?string $stringOrUrl,
        callable $parserFunction
    ): ?array {
        try {
            // If we have a string, let's try to parse the resource from this.
            if ($stringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = $parserFunction($stringOrUrl, true);
                } catch (\Exception $e) {
                    // We don't do anything if it fails - likely we have an URL. Let's continue below.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a resource as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseJson('https://...')`.
             * - `$web->go('...')->parseJson()`.
             */
            $result = $result ?? $parserFunction(
                // Fetch the resource either using $stringOrUrl
                $this->fetchAsset(
                    // Fallback on the current URL, if needed and possible (`go` was used before).
                    $stringOrUrl || !$this->currentPage ? $stringOrUrl : $this->currentUrl()
                ),
                true
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse resource: ' . $e->getMessage());
        }

        return $result;
    }







    /**
     * Parses a given CSV string or fetches the URL and parses it.
     *
     * @param ?string $csvStringOrUrl
     * @return array $data
     */
    public function parseCsv(?string $csvStringOrUrl = null): array
    {
        try {
            // If we have a string, let's try to parse the CSV from this.
            if ($csvStringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = json_decode($csvStringOrUrl, true);
                } catch (\Exception $e) {
                    // We don't do anything if it fails - likely we have an URL. Let's continue below.
                }
            }

            /**
             * We fetch the content and process it, if we haven't got a CSV as a string.
             *
             * This is a work-around to allow for:
             *
             * - `$web->parseJson('https://...')`.
             * - `$web->go('...')->parseJson()`.
             */
            $result = $result ?? json_decode(
                // Fetch the resource either using $csvStringOrUrl
                $this->fetchAsset(
                    // Fallback on the current URL, if needed and possible (`go` was used before).
                    $csvStringOrUrl || !$this->currentPage ? $csvStringOrUrl : $this->currentUrl()
                ),
                true
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $result;
    }


    // // Associate
    // $csv = array_map('str_getcsv', file($file));
    // array_walk($csv, function(&$a) use ($csv) {
    //   $a = array_combine($csv[0], $a);
    // });
    // array_shift($csv);



    /**
     * Parses a given JSON string or fetches the URL and parses it.
     *
     * @param ?string $jsonStringOrUrl
     * @return array $data
     */
    public function parseJson(?string $jsonStringOrUrl = null): array
    {
        try {
            // If we have a string, let's try to parse the JSON from this.
            if ($jsonStringOrUrl !== null) {
                // Simple: Try to parse what we have been given
                try {
                    $result = json_decode($jsonStringOrUrl, true);
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
                    $jsonStringOrUrl || !$this->currentPage ? $jsonStringOrUrl : $this->currentUrl()
                ),
                true
            );
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse JSON: ' . $e->getMessage());
        }

        return $result;
    }

    /**
     * Parses a given XML string or fetches the URL and parses it.
     *
     * @param ?string $xmlStringOrUrl
     * @return array $data
     */
    public function parseXML(?string $xmlStringOrUrl = null): array
    {
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
                $xmlStringOrUrl || !$this->currentPage ? $xmlStringOrUrl : $this->currentUrl()
            ));
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse XML: ' . $e->getMessage());
        }

        return $result;
    }

    protected function xmlDecode(string $xmlString): array
    {
        // XML parser
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);

        return json_decode(json_encode($xml), true);
    }
}
