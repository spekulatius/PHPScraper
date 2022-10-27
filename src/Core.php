<?php

namespace spekulatius;

/**
 * This class organizes mostly. For individual functionality please check the related traits.
 */

class Core
{
    /**
     * This trait manages Guotte itself.
     */
    use UsesGuotte;

    /**
     * This contains the basic filter methods.
     */
    use UsesXPathFilters;

    /**
     * This contains various content-related selectors.
     */
    use UsesContent;
}
