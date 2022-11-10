<?php

namespace spekulatius;

trait UsesParsers
{
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
                    $result = $this->parseXmlString($xmlStringOrUrl);
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
            $result = $result ?? $this->parseXmlString($this->fetchAsset(
                $xmlStringOrUrl || !$this->currentPage ? $xmlStringOrUrl : $this->currentUrl()
            ));
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse XML: ' . $e->getMessage());
        }

        return $result;
    }

    protected function parseXmlString(string $xmlString): array
    {
        // XML parser
        $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);

        return json_decode(json_encode($xml), true);
    }
}
