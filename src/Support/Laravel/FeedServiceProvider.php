<?php

namespace Hpkns\Feed\Support\Laravel;

use Hpkns\Feed\Atom;
use Hpkns\Feed\RSS;
use Illuminate\Support\ServiceProvider;
use Response;

class FeedServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('rss', function(RSS $feed)
        {
            return Response::make($feed->render(), 200, [
                'Content-type' => 'application/rss+xml; Charset=utf-8'
            ]);
        });

        Response::macro('atom', function(Atom $feed){
            return Response::make($feed->render(), 200, [
                'Content-type' => 'application/atom+xml; Charset=utf-8'
            ]);
        });
    }
}
