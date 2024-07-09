<?php

namespace StevenBraham\LaravelNominatimSearch\Components;

use Illuminate\Cache\Repository;

class NominationSearch
{
    private Repository $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Search for a location by query and returns the latitude and longitude
     * @param string $addres
     * 
     * @return array
     */
    public function encodeAddress(string $addres): array
    {
        $queryUrl = 'https://nominatim.openstreetmap.org/search?format=json&q=';
        dd($queryUrl);
    }
}
