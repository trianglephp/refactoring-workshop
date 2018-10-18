<?php

namespace App\Providers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\ServiceProvider;

class TwitterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Twitter', function () {
            return new TwitterOAuth(
                config('services.twitter.consumer.key'),
                config('services.twitter.consumer.secret'),
                config('services.twitter.access.token'),
                config('services.twitter.access.secret')
            );
        });
    }
}
