<?php

namespace Hpkns\Feed;

class RSS extends Feed
{
    protected $itemModel = RSSItem::class;
    protected $rendererModel = Renderers\RSSRenderer::class;

    /**
     * A list of elements that must be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'pubDate', 'lastBuildDate',
    ];
}
