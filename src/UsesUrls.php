<?php

namespace spekulatius;

use League\Uri\Http;
use League\Uri\UriResolver;

trait UsesUrls
{
    public function makeUrlAbsolute(string $url, string $baseUrl = null): string
    {
        return (string) UriResolver::resolve(
            Http::createFromString($url),
            Http::createFromString($baseUrl ?? $this->currentBaseUrl()),
        );
    }
}