<?php

namespace Hpkns\Feed\Support;

class XmlString
{
    public $content;

    /**
     * Initialize the XML section.
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
        return (string)$this->content;
    }
}
