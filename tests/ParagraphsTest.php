<?php

namespace Spekulatius\PHPScraper\Tests;

class ParagraphsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function paragraphTest()
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

        // Get the paragraphs
        $this->assertSame([
            'This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.',
            'There are numerous examples on the website. Please check them out to get more context on how scraping works.',
            'Here would be an example.',
            'Here would be the second example.',
            'Here would be another example.',
            '',
        ], $web->paragraphs);
    }

    /**
     * @test
     */
    public function cleanParagraphTest()
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

        // Get the cleaned up paragraphs
        $this->assertSame([
            'This page contains an example structure to be parsed. It comes with a number of headings and nested paragraphs as an scrape example.',
            'There are numerous examples on the website. Please check them out to get more context on how scraping works.',
            'Here would be an example.',
            'Here would be the second example.',
            'Here would be another example.',
        ], $web->cleanParagraphs);
    }
}
