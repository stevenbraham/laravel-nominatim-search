<?php

namespace StevenBraham\NominatimSearch;

use GuzzleHttp\Client;
use Illuminate\Cache\Repository;
use Illuminate\Support\ServiceProvider;
use StevenBraham\NominatimSearch\Components\NominatimSearch;

class NominatimSearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the NominatimSearch component facade
        $this->app->singleton('nominatim-search', function ($app) {
            return new NominatimSearch(
                $app->make(Repository::class),
                $app->make(Client::class)
            );
        });
    }
}
