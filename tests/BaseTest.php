<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class BaseTest extends TestCase
{
    /**
     * Serves the resources folder locally on port 1989
     */
    public function setUp(): void
    {
        parent::setUp();

        // Spin up a local server to deliver the resources.
        $this->host = 'localhost:8089';
        $this->url = "http://{$this->host}";
        $this->serverDir = __DIR__.'/resources';

        $this->servingProcess = new Process(['php', '-S', $this->host, '-t', $this->serverDir]);
        $this->servingProcess->start();

        // The server needs a little to establish.
        // This is needed to ensure it's up and running before we start testing.
        usleep(500000);
    }

    /**
     * Stops the local server
     */
    public function tearDown(): void
    {
        parent::tearDown();

        // Shutdown the local server
        if (isset($this->servingProcess)) {
            $this->servingProcess->stop(0);
        }
    }

    /**
     * @test
     */
    public function testPageMissing()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        $web->go($this->url . '/page-does-not-exist.html');
        $this->assertSame('404 Not Found', $web->title);
    }
}
