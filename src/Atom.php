<?php

namespace Hpkns\Feed;

class Atom extends Feed
{
    protected $itemModel = AtomEntry::class;
    protected $rendererModel = Renderers\AtomRenderer::class;

    /**
     * A list of elements that must be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'updated'
    ];
}

