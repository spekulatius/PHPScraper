<?php

namespace Tests;

class ListsTest extends BaseTest
{
    /**
     * @test
     */
    public function checkCountTest()
    {
        $web = new \spekulatius\phpscraper();

        /**
         * Navigate to the test page. This page contains:
         *
         * <h2>Example 1: Unordered List</h2>
         * <ul>
         *     <li>Unordered item 1</li>
         *     <li>Unordered item 2</li>
         *     <li>Unordered item with <b>HTML</b></li>
         * </ul>
         *
         * <h2>Example 2: Ordered List</h2>
         * <ol>
         *     <li>Order list item 1</li>
         *     <li>Order list item 2</li>
         *     <li>Order list item with <i>HTML</i></li>
         * </ol>
         */
        $web->go($this->url . '/content/lists.html');

        // Check all lists are recognized
        $this->assertSame(count($web->lists), 2);
        $this->assertSame(count($web->unorderedLists), 1);
        $this->assertSame(count($web->orderedLists), 1);

        // Check the contents
        $this->assertSame([
            'Ordered list item 1',
            'Ordered list item 2',
            'Ordered list item with HTML',
        ], $web->orderedLists[0]['children_plain']);

        $this->assertSame([
            'Unordered list item 1',
            'Unordered list item 2',
            'Unordered list item with HTML',
        ], $web->unorderedLists[0]['children_plain']);
    }
}
