<?php

require_once(__DIR__ . '/vendor/autoload.php');
use Hpkns\Feed\Atom;


$atom = (new Atom())
    ->title('Test')
    ->link(['href' => 'http://localhost', 'rel' => 'self'])
    ->subtitle('A subtitle.')
    ->id('urn:uuid:60a76c80-d399-11d9-b91C-0003939e0af6')
    ->updated('now');

$atom->addItem()
    ->title('Atom-Powered Robots Run Amok')
    ->link(['href' => 'http://example.org/2003/12/13/atom03'])
    ->link([
        'rel' => 'alternate',
        'type' => 'text/html',
        'href' => 'http://example.org/2003/12/13/atom03.html'
    ])
    ->id('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a')
    ->updated('now -1week')
    ->summary('Some summary')
    ->content(['<div><p>Test paragraph</p></div>', 'type' => 'xhtml']);
    //->author(qmsdlfkjqsdfm(['name' => 'John Doe', 'email' => 'johndoe@example.com']));

//header('Content-type: application/xml');
echo $atom->render();

/**
$atom_3 = Atom::create()
    ->title('Exemple Feed'),
    ->subtitle('A subtitle.'),
    ->id('urn:uuid:60a76c80-d399-11d9-b91C-0003939e0af6'),
    ->updated('now');

$atom_3->addItem()
    ->title('Atom-Powered Robots Run Amok'
    ->link('href' => 'http://example.org/2003/12/13/atom03']),
    ->link([
        'rel' => 'alternate',
        'type' => 'text/html',
        'href' => 'http://example.org/2003/12/13/atom03.html'
    ]),
    ->id('urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a'),
    ->updated('now -1week'),
    ->summary('Some summary'),
    ->content('<div><p>Test paragraph</p></div>' 'type' => 'xhtml']),
    ->author(qmsdlfkjqsdfm(['name' => 'John Doe', 'email' => 'johndoe@example.com']));
    **/
