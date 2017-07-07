<?php

namespace Hpkns\Feed\Renderers;

use Hpkns\Feed\Feed;
use DOMDocument;
use DOMElement;
use DateTime;
use Hpkns\Feed\Support\CdataString;
use Hpkns\Feed\Support\XmlString;

abstract class FeedRenderer
{
    /**
     * A list of available namespaces that can be used.
     *
     * @var array
     */
    protected $availableNamespaces = [
        'atom'      => 'http://www.w3.org/2005/Atom',
        'content'   => 'http://purl.org/rss/1.0/modules/content/',
        'dc'        => 'http://purl.org/dc/elements/1.1/',
        'media'     => 'http://search.yahoo.com/mrss/',
        'slash'     => 'http://purl.org/rss/1.0/modules/slash/',
        'sy'        => 'http://purl.org/rss/1.0/modules/syndication/',
        'wfw'       => 'http://wellformedweb.org/CommentAPI/',
    ];

    /**
     * Namespaces included in the final document.
     *
     * @var array
     */
    protected $namespaces = [];

    /**
     * Render a feed.
     *
     * @param  \Hpkns\Rss\Feed $feed
     * @param  array           $options
     * @return string
     */
    public function render(Feed $feed, $options = [])
    {
        $this->createDocumentScaffold(array_merge([
            'xml_version'  => '1.0',
            'xml_encoding' => 'utf-8',
        ], $options));

        foreach ($feed->elements() as $element) {
            $this->channel->appendChild($this->createElement($element['tag'], $element['content'], $element['attributes']));
        }

        foreach ($feed->items() as $item) {
            $i = $this->xml->createElement($this->feedItemType);

            foreach ($item->elements() as $element) {
                $i->appendChild($this->createElement($element['tag'], $element['content'], $element['attributes']));
            }

            $this->channel->appendChild($i);
        }

        foreach ($this->namespaces as $prefix => $url) {
            $this->feed->setAttribute("xmlns:{$prefix}", $url);
        }

        $this->xml->formatOutput = true;
        return $this->xml->saveXML();
    }

    /**
     * Create the base the feed will be built on.
     *
     * @param  array $options
     * @return void
     */
    protected function createDocumentScaffold(array $options = [])
    {
        $this->xml  = new DOMDocument($options['xml_version'], $options['xml_encoding']);
        $this->feed = $this->xml->appendChild($this->xml->createElement($this->rootElementType));

        // A bit of trick here: ATOM expects entries in the root (feed) element, whereas
        // RSS expects them to be in child tag called channel.
        $this->channel = $this->feed;
    }

    /**
     * Add a namespace prefix.
     *
     * @param  string $prefix
     * @param  string $url
     */
    public function addNamespacePrefix($prefix, $url)
    {
        $this->availableNamespaces[$prefix] = $url;
    }

    /**
     * Add a namespace to the list of xmlns that will be included in the root element.
     *
     * @param  string $prefix
     * @return void
     */
    public function addNamespaceToRootElement($prefix)
    {
        $this->namespaces[$prefix] = $this->availableNamespaces[$prefix];
    }

    public function createElement($tag, $content, $attributes)
    {
        if (strpos($tag, ':') !== false) {
            $this->addNamespaceToRootElement(substr($tag, 0, strpos($tag, ':')));
        }

        $content = $this->parseContent($content);
        $element = $this->xml->createElement($tag);
        $element->appendChild($content);

        foreach ($attributes as $key => $value) {
            $element->setAttribute($key, $value);
        }

        return $element;
    }

    /**
     * Apply the required parsings depending on the content type.
     *
     * @param  mixed $content
     * @return string
     */
    public function parseContent($content)
    {
        if ($content instanceof DateTime) {
            $content = $content->format($this->dateFormat);
        }

        if ($content instanceof CdataString) {
            return $this->xml->createCdataSection($content);
        } elseif ($content instanceof XmlString){
            $fragment = $this->xml->createDocumentFragment();
            $fragment->appendXML($content);
            return $fragment;
        }

        return $this->xml->createTextNode($content);
    }
}
