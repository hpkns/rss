<?php

namespace Hpkns\Rss;

class FeedItem
{
    use Support\Features\HasAttributes;

    /**
     * A list of attributes that will be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'pubDate'
    ];

    /**
     * Initiliaze the feed.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }
}
