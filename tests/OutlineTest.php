<?php

namespace Spekulatius\PHPScraper\Tests;

class OutlineTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function outlineTest()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        /**
         * Navigate to the test page. This page contains:
         *
         * <h1>We are testing here!</h1>
         * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
         *
         * <h2>Examples</h2>
         * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
         *
         * <h3>Example 1</h3>
         * <p>Here would be an example.</p>
         *
         * <h3>Example 2</h3>
         * <p>Here would be the second example.</p>
         *
         * <h3>Example 3</h3>
         * <p>Here would be another example.</p>
         */
        $web->go('https://test-pages.phpscraper.de/content/outline.html');

        // Get the content outline
        $this->assertSame(
            [
                [
                    'tag' => 'h1',
                    'content' => 'We are testing here!',
                ], [
                    'tag' => 'h2',
                    'content' => 'Examples',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 1',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 2',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 3',
                ],
            ],
            $web->outline
        );
    }

    /**
     * @test
     */
    public function outlineWithParagraphsTest()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        /**
         * Navigate to the test page. This page contains:
         *
         * <h1>We are testing here!</h1>
         * <p>This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.</p>
         *
         * <h2>Examples</h2>
         * <p>There are numerous examples on the website. Please check them out to get more context on how scraping works.</p>
         *
         * <h3>Example 1</h3>
         * <p>Here would be an example.</p>
         *
         * <h3>Example 2</h3>
         * <p>Here would be the second example.</p>
         *
         * <h3>Example 3</h3>
         * <p>Here would be another example.</p>
         *
         * <!-- an empty paragraph to check if it gets filtered out correctly -->
         * <p></p>
         */
        $web->go('https://test-pages.phpscraper.de/content/outline.html');

        // Get the content outline
        $this->assertSame(
            [
                [
                    'tag' => 'h1',
                    'content' => 'We are testing here!',
                ], [
                    'tag' => 'p',
                    'content' => 'This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.',
                ], [
                    'tag' => 'h2',
                    'content' => 'Examples',
                ], [
                    'tag' => 'p',
                    'content' => 'There are numerous examples on the website. Please check them out to get more context on how scraping works.',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 1',
                ], [
                    'tag' => 'p',
                    'content' => 'Here would be an example.',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 2',
                ], [
                    'tag' => 'p',
                    'content' => 'Here would be the second example.',
                ], [
                    'tag' => 'h3',
                    'content' => 'Example 3',
                ], [
                    'tag' => 'p',
                    'content' => 'Here would be another example.',
                ], [
                    'tag' => 'p',
                    'content' => '',
                ],
            ],
            $web->outlineWithParagraphs
        );
    }
}
