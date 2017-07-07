<?php

use PHPUnit\Framework\TestCase;
use Hpkns\Feed\RSS;

class RssTest extends TestCase
{
    public function testRSS()
    {
        $rss = new RSS([
            'title'         => 'Test Feed',
            'description'   => 'Test Feed description' ,
            'link'          => 'http://hupkens.be/feed.xml',
            'image'         => xml_string("<url>http://hupkens.be/feed-image.png</url><title>Test Feed</title><link>http://hupkens.be/feed.xml</link>"),
            'generator'     => 'hpkns\rss',
            'lastBuildDate' => 'December 12 1985',
            'copyright'     => cdata_string('Copyright &copy; 2017 Thomas Hupkens'),
            'language'      => 'en-en',
            'ttl'           => '10',
        ]);

        $rss->addItem([
            'title'         => cdata_string('This is the title of the content'),
            'description'   => cdata_string('This is the description'),
            'link'          => 'http://hupkens.be/feed/1/',
            'guid'          => ['http://hupkens.be/feed/1/', 'isPermaLink' => 'true'],
            'pubDate'       => 'January 10 2016',
            'media:thumbnail'
            => ['width' => '600', 'height' => '400', 'url' => 'http://hupkens.be/feed/1/image.png'],
        ]);

        $this->assertEquals(file_get_contents(__DIR__ . '/reference/rss.xml'), $rss->render());
    }
}
