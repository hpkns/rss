<?php

if (! function_exists('camel_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string $str
     * @return string
     */
    function camel_case($str)
    {
        $str = ucwords(str_replace(['-', '_', ':'], ' ', $str));

        return lcfirst(str_replace(' ', '', $str));
    }
}

if (! function_exists('cdata_string')) {
    /**
     * Convert a string to a CDATA string.
     *
     * @return Hpkns\Feed\Support\CdataString
     */
    function cdata_string($content)
    {
        return new Hpkns\Feed\Support\CdataString($content);
    }
}

if (! function_exists('xml_string')) {
    /**
     * Convert a string to a CDATA string.
     *
     * @return Hpkns\Feed\Support\CdataString
     */
    function xml_string($content)
    {
        return new Hpkns\Feed\Support\XmlString($content);
    }
}
