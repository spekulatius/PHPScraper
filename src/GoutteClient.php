<?php

namespace Spekulatius\PHPScraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Extended Goutte\Client with PHPScraper specific methods
 */

class GoutteClient extends Client
{
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
     * Remember permanent redirect url and detect if the redirect chain contains temporary redirects
     *
     * @return Crawler
     */
    public function followRedirect(): Crawler
    {
        $status = $this->internalResponse->getStatusCode();
        if($status === 200 /* META REFRESH */ || $status === 301 /* Moved Permanently */ || $status === 308 /* Permanent Redirect */) {
            if(!$this->usesTemporaryRedirect && empty($this->internalResponse->getHeader('Retry-After')))
                $this->permanentRedirectUrl = $this->redirect;
        } else {    // $status === 300 /* Multiple Choices */ || $status === 302 /* Found */ || $status === 303 /* See Other */ || $status === 307 /* Temporary Redirect */
            $this->usesTemporaryRedirect = true;
        }
        // 300 Multiple Choices might also be handled as permanent redirect
        // META REFRESH might also be handled as temporary redirect if the delay is > 1s
        return parent::followRedirect();
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
        if(!empty($retryAfterHeaders)) {
            $status = $this->internalResponse->getStatusCode();
            foreach($retryAfterHeaders as $retryAfter) {
                if(is_numeric($retryAfter))
                    $retryAt = time() + $retryAfter;
                else
                    $retryAt = strtotime($retryAfter);
                if($status >= 400) {    // usually 429 Too Many Request or 503 Service Unavailable
                    if($this->retryFailureAt < $retryAt)
                        $this->retryFailureAt = $retryAt;
                } elseif($status >= 300) {
                    if($this->retryRedirectAt > $retryAt)
                        $this->retryRedirectAt = $retryAt;
                }
            }
        }
        return parent::filterResponse($response);
    }

    /**
     * Calculate the earliest moment to retry the request
     *
     * @return Response
     */
    public function retryAt(): int {
        if($this->retryFailureAt)
            return $this->retryFailureAt;
        if($this->retryRedirectAt < PHP_INT_MAX)
            return $this->retryRedirectAt;
        return 0;
    }
}