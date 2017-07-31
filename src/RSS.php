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

    /**
     * Allow a shorter atom self.
     *
     * @param  string $url
     * @return void
     */
    public function setAtomSelfElement($url)
    {
        $this->elements[] = [
            'tag' => 'atom:link',
            'content' => null,
            'attributes' => [
                "href" => $url, "rel" => "self", "type" => "application/rss+xml"
            ]
        ];
    }
}
