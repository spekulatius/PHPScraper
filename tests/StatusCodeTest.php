<?php

namespace Spekulatius\PHPScraper\Tests;

class StatusCodeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testAccessErrorBeforeNavigation()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('You can not access the status code before your first navigation using `go`.');

        $web->statusCode;
    }

    /**
     * @test
     */
    public function testOk()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page without redirect
        $web->go('https://phpscraper.de/');

        // Check the status itself.
        $this->assertSame(200, $web->statusCode);

        // Check the detailed states.
        $this->assertTrue($web->isSuccess);
        $this->assertFalse($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testNotFound()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page which doesn't exist.
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');

        // Check the status itself.
        $this->assertSame(404, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->isSuccess);
        $this->assertFalse($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertTrue($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testPermanentRedirect()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page with 301 permanent redirect
        $web->go('http://phpscraper.de/');

        // Check the status itself.
        $this->assertSame(200, $web->statusCode);

        // Check the detailed states.
        $this->assertTrue($web->isSuccess);
        $this->assertFalse($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('https://phpscraper.de/', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testTemporaryRedirect()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page with 307 temporary redirect
        $web->go('https://httpstat.us/307');

        // Check the status itself.
        $this->assertSame(200, $web->statusCode);

        // Check the detailed states.
        $this->assertTrue($web->isSuccess);
        $this->assertTrue($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertTrue($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testGone()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page
        $web->go('https://httpstat.us/410');

        // Check the status itself.
        $this->assertSame(410, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->isSuccess);
        $this->assertFalse($web->isTemporaryResult);
        $this->assertTrue($web->isGone);
        $this->assertTrue($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testTooManyRequests()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page which returns "429 Too Many Requests" with "Retry-At: 5" header
        $t1 = time();
        $web->go('https://httpstat.us/429');
        $t2 = time();

        // Check the status itself.
        $this->assertSame(429, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->isSuccess);
        $this->assertTrue($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertGreaterThan($t1, $web->retryAt);
        $this->assertLessThanOrEqual($t2 + 5, $web->retryAt);
    }

    /**
     * @test
     */
    public function testNetworkError()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page which is invalid
        $web->go('https://example.tld/');

        // Check the status itself.
        $this->assertSame(0, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->isSuccess);
        $this->assertTrue($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

    /**
     * @test
     */
    public function testTimeout()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper(['timeout' => 0]);

        // Navigate to the test page
        $web->go('https://phpscraper.de/');

        // Check the status itself.
        $this->assertSame(499, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->isSuccess);
        $this->assertTrue($web->isTemporaryResult);
        $this->assertFalse($web->isGone);
        $this->assertFalse($web->isPermanentError);

        // Check the request properties
        $this->assertFalse($web->usesTemporaryRedirect);
        $this->assertSame('', $web->permanentRedirectUrl);
        $this->assertSame(0, $web->retryAt);
    }

}
