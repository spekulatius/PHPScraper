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
        $this->assertTrue($web->isSuccess);
        $this->assertFalse($web->isClientError);
        $this->assertFalse($web->isServerError);

        // Assert access-helpers
        $this->assertFalse($web->isForbidden);
        $this->assertFalse($web->isNotFound);
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
        $this->assertTrue($web->isClientError);
        $this->assertFalse($web->isServerError);

        // Assert access-helpers
        $this->assertFalse($web->isForbidden);
        $this->assertTrue($web->isNotFound);
    }
}
