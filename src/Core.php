<?php

namespace spekulatius;

/**
 * This class organizes mostly. For individual functionality check the related traits please.
 */

class Core
{
    /**
     * Url related helpers.
     */
    use UsesUrls;

    /**
     * This trait manages Goutte itself.
     */
    use UsesGoutte;

    /**
     * This contains the basic filter methods.
     */
    use UsesXPathFilters;

    /**
     * This contains various content-related selectors.
     */
    use UsesContent;

    /**
     * Shared simple parsers for XML, JSON and CSV.
     */
    use UsesParsers;

    /**
     * This contains the feeds-related selectors and parsers.
     */
    use UsesFeeds;
}
