<?php

namespace Hpkns\Feed\Renderers;

use DateTime;

class RSSRenderer extends FeedRenderer
{
    /**
     * The name of the tag at the root of the three.
     *
     * @var string
     */
    protected $rootElementType = 'rss';

    /**
     * The type used by the items.
     *
     * @var string
     */
    protected $feedItemType = 'item';

    /**
     * The code used to format dates.
     *
     * @param string
     */
    protected $dateFormat = DATE_RSS;

    /**
     * Create the base the feed will be built on.
     *
     * @param  array $options
     * @return void
     */
    protected function createDocumentScaffold(array $options = [])
    {
        parent::createDocumentScaffold($options);

        $this->feed->setAttribute('version', '2.0');
        $this->channel = $this->feed->appendChild($this->xml->createElement('channel'));
    }
}
