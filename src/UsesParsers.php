<?php

namespace spekulatius;

trait UsesParsers
{
    public function parseJson(?string $jsonString = null): array
    {
        // See if we can parse the current URL already. If not, navigate to the usual URL.
        try {
            return json_decode($jsonString, true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse JSON: ' . $e->getMessage());
        }
    }

    public function parseXml(?string $xmlString = null): array
    {
        try {
            $xml = simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);

            return json_decode($json, true);
        } catch (\Exception $e) {
            throw new \Exception('Failed to parse XML: ' . $e->getMessage());
        }
    }
}