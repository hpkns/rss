<?php

namespace Hpkns\Rss\Support\Features;

use Datetime;

trait HasAttributes
{
    /**
     * The attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set an attribute.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return void
     */
    public function setAttribute($key, $value)
    {
        $method = snake_case("set_{$key}_attribute");

        if (method_exists($this, $method)) {
            return $this->{$method}($value);
        }

        if (isset($this->dates) && in_array($key, $this->dates)) {
            $value = $this->castDate($value);
        }

        $this->attributes[$key] = $value;
    }

    /**
     * Return an attribute.
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getAttribute($key, $default = null)
    {
        $method = snake_case("get_{$key}_attribute");

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        if (array_key_exists($key, $this->attributes)) {
            $value = $this->attributes[$key];

            if (isset($this->dates) && in_array($key, $this->dates)) {
                $value = $value->format('D, d M Y H:i:s O');
            }

            return $value;
        }

        return $default;
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
     * Return a list of all the keys that were set in $this->attributes.
     *
     * @return string
     */
    public function keys()
    {
        return array_keys($this->attributes);
    }

    /**
     * Return all the attributes, after applying the required castings to them.
     *
     * @return array
     */
    public function all()
    {
        $attributes = [];

        foreach (array_keys($this->attributes) as $key) {
            $attributes[$key] = $this->getAttribute($key);
        }

        return $attributes;
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
            $this->setAttribute($key, $value);
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
            $this->setAttribute($method, $params[0]);
        } else {
            throw new \LogicException('At least one parameter is required for the fluent setter to work.');
        }

        return $this;
    }
}
