<?php

namespace spekulatius;

trait UsesParsers
{
    public function parseJson(?string $jsonString = null): array
    {
        // If no string was given, we use the current content.
        if ($jsonString === null) {
            // @todo
        }

        // See if we can parse the current URL already. If not, navigate to the usual URL.
        try {
            return json_decode($jsonString, true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse JSON: ' . $e->getMessage());
        }
    }

    public function parseXML(?string $xmlString = null): array
    {
        // If no string was given, we use the current content.
        if ($xmlString === null) {
            // @todo
        }

        try {
            $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);

            return json_decode($json, true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse XML: ' . $e->getMessage());
        }
    }
}