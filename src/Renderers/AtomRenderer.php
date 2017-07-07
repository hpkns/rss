<?php

namespace Hpkns\Feed\Renderers;

use DateTime;

class AtomRenderer extends FeedRenderer
{
    /**
     * The name of the tag at the root of the three.
     *
     * @var string
     */
    protected $rootElementType = 'feed';

    /**
     * The type used by the items.
     *
     * @var string
     */
    protected $feedItemType = 'entry';

    /**
     * The code used to format dates.
     *
     * @param string
     */
    protected $dateFormat = DATE_ATOM;
}
