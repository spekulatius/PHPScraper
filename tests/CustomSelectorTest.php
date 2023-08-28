<?php

namespace Spekulatius\PHPScraper\Tests;

class CustomSelectorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testFailedSelectionBasedOnId()
    {
        // Navigate to test page
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go('https://test-pages.phpscraper.de/content/selectors.html');

        // Ensure we got the test page.
        $this->assertSame(
            'Selector Tests',
            $web->title
        );

        // Trigger failing test.
        try {
            $web->filterFirstText("//[@id='by-id']");
        } catch (\Exception $e) {
            $this->assertSame(
                'DOMXPath::query(): Invalid expression',
                $e->getMessage()
            );
        }
    }

    /**
     * @test
     */
    public function testSelectionBasedOnId()
    {
        // Navigate to test page
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go('https://test-pages.phpscraper.de/content/selectors.html');

        // Ensure we got the test page.
        $this->assertSame(
            'Selector Tests',
            $web->title
        );

        // Select content using `->text()`
        $this->assertSame(
            'Content by ID',
            $web->filterFirstText("//*[@id='by-id']")
        );
    }

    /**
     * @test
     */
    public function testSelectionBasedOnTag()
    {
        // Navigate to test page
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go('https://test-pages.phpscraper.de/content/selectors.html');

        // Ensure we got the test page.
        $this->assertSame(
            'Selector Tests',
            $web->title
        );

        // Select single string using first and chain `->text()`
        $this->assertSame(
            'Selector Tests (h1)',
            $web->filterFirst('//h1')->text()
        );

        // Select as array using `filterTexts`:
        $this->assertSame(
            ['Selector Tests (h1)'],
            $web->filterTexts('//h1')
        );
    }

    /**
     * @test
     */
    public function testSelectionBasedOnClass()
    {
        // Navigate to test page
        $web = new \Spekulatius\PHPScraper\PHPScraper;
        $web->go('https://test-pages.phpscraper.de/content/selectors.html');

        // Ensure we got the test page.
        $this->assertSame(
            'Selector Tests',
            $web->title
        );

        // Select without `->text()` and using the filterTexts-method instead.
        $this->assertSame(
            ['Content by Class 1', 'Content by Class 2'],
            $web->filterTexts("//*[@class='by-class']")
        );
    }
}
