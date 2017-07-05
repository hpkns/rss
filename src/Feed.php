<?php

namespace Hpkns\Rss;

class Feed
{
    use Support\Features\HasAttributes;

    /**
     * A list of attributes that will be casted as dates.
     *
     * @var array
     */
    protected $dates = [
        'pubDate', 'lastBuildDate'
    ];

    /**
     * A list of of items.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Initiliaze the feed.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Add a new item and return it.
     *
     * @param  array|void $attributes
     */
    public function addItem($attributes = [])
    {
        $item = new FeedItem($attributes);

        $this->items[] = $item;

        return $item;
    }

    /**
     * Add items provided as an array.
     *
     * @param  array $items
     * @return void
     */
    public function addItems(array $items = [])
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Getter for $this->items.
     *
     * @return array
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * Render the feed.
     *
     * @param  string $type    This parameter does nothing (yet)
     * @param  array  $options
     * @return string
     */
    public function render($type = 'rss', array $options = [])
    {
       $renderer = new Renderers\RssRenderer();

       return $renderer->render($this, $options);
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render('rss', []);
    }

    /**
     * SETTERS
     */
    public function setAtomLinkAttribute($value)
    {
        if (is_string($value)) {
            $value = [
                'href' => $value,
                'rel' => 'self',
                'type' => 'application/rss+xml',
            ];
        }

        $this->attributes['atom:link'] = $value;
    }
}
