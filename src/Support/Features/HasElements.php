<?php

namespace Hpkns\Feed\Support\Features;

use Datetime;

trait HasElements
{
    /**
     * The elements.
     *
     * @var array
     */
    protected $elements = [];

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
     * Add an element.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function addElement($tag, $content, $attributes = [])
    {
        $method = camel_case(str_replace(':', '_', "set_{$tag}__element"));

        if (method_exists($this, $method)) {
            return $this->{$method}($content);
        }

        if (is_array($content)) {
            return $this->addElement(
                $tag,
                $content[0] ?? null,
                array_filter($content, 'is_string', ARRAY_FILTER_USE_KEY)
            );
        }

        if (isset($this->dates) && in_array($tag, $this->dates)) {
            $content = $this->castDate($content);
        }

        $this->elements[] = compact('tag', 'content', 'attributes');
    }

    /**
     * Convert (if need be) to a proper date.
     *
     * @param  mixed $date
     * @return \Datetime
     */
    public function castDate($date)
    {
        if ($date instanceof Datetime) {
            return $date;
        } else if (is_int($date) || is_numeric($date)) {
            $parsed = (new Datetime)->setTimestamp($date);

            if ($parsed !== false) {
                return $parsed;
            }
        }

        return new Datetime($date);
    }

    /**
     * Fill the object using key/values found in an array.
     *
     * @param  array $attributes
     * @return $this
     */
    public function fill(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->addElement($key, $value);
        }

        return $this;
    }

    /**
     * Fluent setter used for method chaining.
     *
     * @param  string $method
     * @param  array  $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if (count($params)) {
            if (count($params) == 1) {
                $this->addElement($method, $params[0]);
            } else {
                $this->addElement($method, $params[0], $params[1]);
            }
        } else {
            throw new \LogicException('At least one parameter is required for the fluent setter to work.');
        }

        return $this;
    }

    /**
     * Return all the elements.
     *
     * @return array
     */
    public function elements()
    {
        return $this->elements;
    }
}
