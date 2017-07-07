<?php

namespace Hpkns\Feed;

class Feed
{
    use Support\HasElements;

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
     * @var string
     */
    protected $itemModel;

    /**
     * @var string
     */
    protected $rendererModel;

    /**
     * Add a new item and return it.
     *
     * @param  array|void $attributes
     */
    public function addItem($attributes = [])
    {
        $model = $this->itemModel;
        $item = new $model($attributes);

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
     * @param  array $options
     * @return string
     */
    public function render($options = [])
    {
        $model = $this->rendererModel;

        return (new $model($options))->render($this);
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render([]);
    }
}
