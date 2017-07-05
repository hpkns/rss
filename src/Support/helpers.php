<?php

if (! function_exists('camel_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string $str
     * @return string
     */
    function snake_case($str)
    {
        $str = ucwords(str_replace(['-', '_', ':'], ' ', $str));

        return lcfirst(str_replace(' ', '', $str));
    }
}
