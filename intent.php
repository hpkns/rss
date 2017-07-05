<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Hpkns\Rss\Feed;

$rss = (new Feed([
    'title'         => 'BBC News - Home',
    'description'   => 'BBC News - Home',
    'link'          => 'http://www.bbc.co.uk/news/',
    'atom:link'     => 'http://www.bbc.co.uk/news/',
    'generator'     => 'RSS for Node',
    'lastBuildDate' => 'now',
    'dc:title'      => 'Prout',
    'copyright'     => 'Copyright: (C) British Broadcasting Corporation, see http://news.bbc.co.uk/2/hi/help/rss/4498287.stm for terms and conditions of reuse.',
    'language'      => 'en-gb',
    'ttl'           => '15',
]))->addItems([
    [
        'title'         =>  'Grenfell Tower: Government sends in \'taskforce\'',
        'description'   => 'The team will take over housing and run other parts of the council in the wake of the tower fire.]]></description>',
        'link'          => 'http://www.bbc.co.uk/news/uk-40504145',
        'guid'          => ['http://www.bbc.co.uk/news/uk-40504145', 'isPermaLink' => 'true'],
        'pubDate'       => '2017-07-05 09:00:00',
        'media:thumbnail' => [
            'width' => 976, 'height' => 549, 'url' => 'http://c.files.bbci.co.uk/10D25/production/_96810986_mediaitem96810982.jpg'
        ],
    ]
]);


header('Content-type: application/xml; Charset=utf-8');
echo $rss->render();
