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

        // Navigate to the test page: This redirects to phpscraper.de
        $web->go('https://phpscraper.de');

        // Check the status itself.
        $this->assertSame(200, $web->statusCode);

        // Check the detailed states.
        $this->assertTrue($web->is2xx);
        $this->assertFalse($web->is4xx);
        $this->assertFalse($web->is5xx);
        $this->assertTrue($web->is200);
        $this->assertFalse($web->is400);
        $this->assertFalse($web->is401);
        $this->assertFalse($web->is402);
        $this->assertFalse($web->is403);
        $this->assertFalse($web->is404);
        $this->assertFalse($web->is500);

        // Assert access-helpers
        $this->assertTrue($web->isOk);
        $this->assertFalse($web->isUnauthorized);
        $this->assertFalse($web->isForbidden);
        $this->assertFalse($web->isNotFound);
        $this->assertFalse($web->isServerError);
        $this->assertFalse($web->isInternalServerError);
    }

    /**
     * @test
     */
    public function testNotFound()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page: This redirects to phpscraper.de
        $web->go('https://test-pages.phpscraper.de/page-does-not-exist.html');

        // Check the status itself.
        $this->assertSame(404, $web->statusCode);

        // Check the detailed states.
        $this->assertFalse($web->is2xx);
        $this->assertTrue($web->is4xx);
        $this->assertFalse($web->is5xx);
        $this->assertFalse($web->is200);
        $this->assertFalse($web->is400);
        $this->assertFalse($web->is401);
        $this->assertFalse($web->is402);
        $this->assertFalse($web->is403);
        $this->assertTrue($web->is404);
        $this->assertFalse($web->is500);

        // Assert access-helpers
        $this->assertFalse($web->isOk);
        $this->assertFalse($web->isUnauthorized);
        $this->assertFalse($web->isForbidden);
        $this->assertTrue($web->isNotFound);
        $this->assertFalse($web->isServerError);
        $this->assertFalse($web->isInternalServerError);
    }
}
