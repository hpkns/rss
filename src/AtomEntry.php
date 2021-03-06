<?php

namespace  Hpkns\Feed;

use Hpkns\Feed\Support\Features\HasElements;

class AtomEntry
{
    use HasElements;

    /**
     * A list of elements that must be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'updated'
    ];
}
