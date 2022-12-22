<?php

namespace Spekulatius\PHPScraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpClient\Exception\TimeoutException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Extended Goutte\Client with PHPScraper specific methods
 */
class GoutteClient extends Client
{
    /**
     * Is this the main request or a subrequest?
     *
     * (should always contain the same value as the private parent::$isMainRequest)
     *
     * @var bool
     */
    private $isMainRequest = true;

    /**
     * Was a temporary redirect involved in loading this request?
     *
     * @var bool
     */
    public $usesTemporaryRedirect = false;

    /**
     * Should subsequent requests go to a different URL?
     *
     * @var string
     */
    public $permanentRedirectUrl = null;

    /**
     * Which is the earliest moment to retry the request because of an outdated redirect? (unix timestamp)
     *
     * @var int
     */
    protected $retryRedirectAt = PHP_INT_MAX;

    /**
     * Which is the earliest moment to retry the request because of a failed request? (unix timestamp)
     *
     * @var int
     */
    protected $retryFailureAt = 0;

    /**
     * Reset internal variables before calling a URI.
     *
     * @param string $method        The request method
     * @param string $uri           The URI to fetch
     * @param array  $parameters    The Request parameters
     * @param array  $files         The files
     * @param array  $server        The server parameters (HTTP headers are referenced with an HTTP_ prefix as PHP does)
     * @param string $content       The raw body data
     * @param bool   $changeHistory Whether to update the history or not (only used internally for back(), forward(), and reload())
     */
    public function request(string $method, string $uri, array $parameters = [], array $files = [], array $server = [], string $content = null, bool $changeHistory = true): Crawler
    {
        if ($this->isMainRequest) {
            $this->usesTemporaryRedirect = false;
            $this->permanentRedirectUrl = null;
            $this->retryRedirectAt = PHP_INT_MAX;
            $this->retryFailureAt = 0;
        }
        try {
            return parent::request($method, $uri, $parameters, $files, $server, $content, $changeHistory);
        } catch (TimeoutException $e) {
            $content = $e->getMessage();
            $status = 499;    // Client Closed Request
        } catch (TransportExceptionInterface $e) {
            $content = $e->getMessage();
            $status = 0;    // Network Error
        }
        $this->response = new Response($content, $status, ['Content-Type' => 'text/plain', 'Content-Length' => strlen($content), 'Date' => gmdate('D, d M Y H:i:s T')]);
        $this->internalResponse = $this->filterResponse($this->response);
        $this->redirect = null;
        $this->crawler = $this->createCrawlerFromContent($this->internalRequest->getUri(), $this->internalResponse->getContent(), $this->internalResponse->getHeader('Content-Type') ?? '');
        return $this->crawler;
    }

    /**
     * Remember permanent redirect url and detect if the redirect chain contains temporary redirects
     *
     * @return Crawler
     */
    public function followRedirect(): Crawler
    {
        $this->isMainRequest = false;
        $status = $this->internalResponse->getStatusCode();
        if ($status === 200 /* META REFRESH */ || $status === 301 /* Moved Permanently */ || $status === 308 /* Permanent Redirect */) {
            if (!$this->usesTemporaryRedirect && empty($this->internalResponse->getHeader('Retry-After'))) {
                $this->permanentRedirectUrl = $this->redirect;
            }
        } else {    // $status === 300 /* Multiple Choices */ || $status === 302 /* Found */ || $status === 303 /* See Other */ || $status === 307 /* Temporary Redirect */
            $this->usesTemporaryRedirect = true;
        }
        // 300 Multiple Choices might also be handled as permanent redirect
        // META REFRESH might also be handled as temporary redirect if the delay is > 1s
        $response = parent::followRedirect();
        $this->isMainRequest = true;
        return $response;
    }

    /**
     * Evaluate the Retry-After header
     *
     * see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Retry-After
     *
     * @return Response
     */
    protected function filterResponse(object $response)
    {
        $retryAfterHeaders = $response->getHeader('Retry-After', false);
        if (!empty($retryAfterHeaders)) {
            $status = $response->getStatusCode();
            foreach ($retryAfterHeaders as $retryAfter) {
                if (is_numeric($retryAfter)) {
                    $retryAt = time() + $retryAfter;
                } else {
                    $retryAt = strtotime($retryAfter);
                }
                if ($status >= 400) {    // usually 429 Too Many Request or 503 Service Unavailable
                    if ($this->retryFailureAt < $retryAt) {
                        $this->retryFailureAt = $retryAt;
                    }
                } elseif ($status >= 300) {
                    if ($this->retryRedirectAt > $retryAt) {
                        $this->retryRedirectAt = $retryAt;
                    }
                }
            }
        }

        return parent::filterResponse($response);
    }

    /**
     * Calculate the earliest moment to retry the request
     *
     * @return int
     */
    public function retryAt(): int
    {
        if ($this->retryFailureAt) {
            return $this->retryFailureAt;
        }
        if ($this->retryRedirectAt < PHP_INT_MAX) {
            return $this->retryRedirectAt;
        }

        return 0;
    }
}
