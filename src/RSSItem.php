<?php

namespace  Hpkns\Feed;

use Hpkns\Feed\Support\HasElements;

class RSSItem
{
    use HasElements;

    /**
     * A list of elements that must be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'pubDate', 'lastBuildDate',
    ];
}