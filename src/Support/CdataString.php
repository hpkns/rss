<?php

namespace Hpkns\Feed\Support;

class CdataString
{
    public $content;

    /**
     * Initialize the CDATA section.
     *
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Convert the section to string.
     *
     * @return string.
     */
    public function __toString()
    {
        return $this->content;
    }
}
