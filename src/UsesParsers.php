<?php

namespace spekulatius;

trait UsesParsers
{
    /**
     * Parse a CSV.
     *
     * @return array $data
     */
    public function parseCsv(): array
    {

    }

    /**
     * Parse a CSV.
     *
     * @return array $data
     */
    public function parseCsv1(): array
    {

    }

    /**
     * Parse a CSV.
     *
     * @return array $data
     */
    public function parseCsv2(): array
    {

    }


    /**
     * Parse a CSV.
     *
     * @return array $data
     */
    public function parseCsv3(): array
    {

    }



    public function csvDecodeRaw()
    {
        try {

    // @todo implement
    // string $separator = ",",
    // string $enclosure = "\"",
    // string $escape = "\\"

            $array = array_map('str_getcsv', explode("\n", $csvString));
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse CSV: ' . $e->getMessage());
        }

        return $array;
    }

    public function csvDecodeWithHeaderRaw(
        string $csvString,
        ?array $options = []
    ): array
    {
        // merge options with the configuration and the global defaults
        $config = array_merge(
            $this->config

        );

        $array = [];

        try {

    // @todo implement
    // string $separator = ",",
    // string $enclosure = "\"",
    // string $escape = "\\"

            $array = array_map('str_getcsv', explode("\n", $csvString));

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
    ): array
    {
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
