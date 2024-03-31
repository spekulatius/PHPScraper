<?php

namespace Spekulatius\PHPScraper;

use League\Uri\Http;
use League\Uri\Uri;
use League\Uri\UriResolver;

trait UsesUrls
{
    /**
     * Returns the current url - this is either set by `go` indirectly or directly using `setContent`.
     *
     * @return string $url
     *
     * @throws \Exception
     */
    public function currentUrl(): string
    {
        // Ensure we aren't having a "call on null" without context.
        if ($this->currentPage === null) {
            throw new \Exception('You can not access the URL before your first navigation using `go`.');
        }

        return (string) $this->currentPage->getUri();
    }

    /**
     * Returns the current host
     *
     * @return string|null $host
     */
    public function currentHost(): ?string
    {
        return Uri::new($this->currentUrl())->getHost();
    }

    /**
     * Returns the current host as defined in `<base href="...">` or the current host.
     *
     * @return string $baseUrl
     */
    public function currentBaseHost(): string
    {
        $uri = Uri::new($this->baseHref() ?? $this->currentUrl());

        return $uri->getScheme() . '://' . $uri->getHost();
    }

    /**
     * Converts a current URL to be absolute based on <base> or current page.
     *
     * @return ?string $absoluteUrl
     */
    public function makeUrlAbsolute(?string $url = null, ?string $baseUrl = null): ?string
    {
        // Allow to pass null through
        if ($url === null || $this->currentPage === null) {
            return null;
        }

        // Resolve the Url using one of the provided/set base href.
        return (string) UriResolver::resolve(
            Http::new($url),
            Http::new($baseUrl ?? $this->baseHref() ?? $this->currentBaseHost()),
        );
    }
}
