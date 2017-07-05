<?php

namespace Hpkns\Rss\Renderers;

use Hpkns\Rss\Feed;
use DOMDocument;
use DOMElement;

class RssRenderer
{
    /**
     * Available NS.
     *
     * @var array
     */
    protected $available_ns = [
        'atom'      => 'http://www.w3.org/2005/Atom',
        'content'   => 'http://purl.org/rss/1.0/modules/content/',
        'dc'        => 'http://purl.org/dc/elements/1.1/',
        'media'     => 'http://search.yahoo.com/mrss/',
        'slash'     => 'http://purl.org/rss/1.0/modules/slash/',
        'sy'        => 'http://purl.org/rss/1.0/modules/syndication/',
        'wfw'       => 'http://wellformedweb.org/CommentAPI/',
    ];

    /**
     * Render a feed to XML.
     *
     * @param  \Hpkns\Rss\Feed $feed
     * @param  array           $options
     * @return string
     */
    public function render(Feed $feed, $options = [])
    {
        list($xml, $rss, $channel) = $this->createDocumentRoot();

        $this->configureChannel($channel, $feed, $options);
        $this->addItems($channel, $feed->items());

        $xml->formatOutput = true;
        return $xml->saveXML();
    }

    /**
     * Create the root of the document.
     *
     * @return array
     */
    public function createDocumentRoot()
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $rss = $xml->appendChild(new DOMElement('rss'));
        $rss->setAttribute('version', '2.0');

        $channel = $rss->appendChild(new DOMElement('channel'));

        return [$xml, $rss, $channel];
    }

    /**
     * Add the tags to channel node.
     *
     * @param  \DOMDocument    $channel
     * @param  \Hpkns\Rss\Feed $feed
     * @return void
     */
    public function configureChannel(DOMElement $channel, Feed $feed)
    {
        foreach ($feed->all() as $tag => $content) {
            $channel->appendChild($this->createNode($tag, $content, $channel));
        }
    }

    /**
     * Add the tags to channel node.
     *
     * @param  \DOMDocument $channel
     * @param  array        $items
     * @return void
     */
    public function addItems(DOMElement $channel, array $items)
    {
        foreach ($items as $items) {
            $item = $channel->ownerDocument->createElement('item');

            foreach ($items->all() as $key => $value) {
                $item->appendChild($this->createNode($key, $value, $channel));
            }

            $channel->appendChild($item);
        }
    }

    public function loadNS($document, $ns)
    {
        $document->firstChild->setAttribute("xmlns:{$ns}", $this->available_ns[$ns]);
    }

    public function createNode($tag, $content, $channel)
    {
        if (($pos = strpos($tag, ':')) !== false) {
            $this->loadNS($channel->ownerDocument, substr($tag, 0, $pos));
        }

        if (is_array($content)) {
            $attributes = array_filter($content, 'is_string', ARRAY_FILTER_USE_KEY);
            $content = isset($content[0]) ? $content[0] : null;
        } else {
            $attributes = [];
        }

        $node = $channel->ownerDocument->createElement($tag, $content);

        foreach ($attributes as $key => $value) {
            $node->setAttribute($key, $value);
        }

        return $node;
    }
}
