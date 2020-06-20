<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

final class KeywordTest extends TestCase
{
    /**
     * @test
     */
    public function testExtractionExamples()
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page.
        // It contains 3 paragraphs from the English Wikipedia article for "lorem ipsum"
        $web->go('https://test-pages.phpscraper.de/content/keywords.html');

        // Check the keywords on this case...
        $keywords = $web->contentKeywords;

        // a selected list of keywords to expect
        $shouldKeywords = [
            '1960s',
            'added',
            'adopted lorem ipsum',
            'advertisements',
            'aldus employed',
            'corrupted version',
            'graphic',
            'improper latin',
            'introduced',
            'keyword extraction tests',
            'test',
            'microsoft word',
            'english wikipedia',
            'lorem ipsum',
            'lorem ipsum text',
        ];

        // check if all are part of the output
        foreach ($shouldKeywords as $keyword) {
            $this->assertTrue(in_array($keyword, $keywords));
        }
    }
}
