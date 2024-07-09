<?php

namespace StevenBraham\NominatimSearch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the NominatimSearch component.
 * @see \StevenBraham\NominatimSearch\Components\NominatimSearch
 * @method static array|null encodeAddress(string $addres)
 */
class NominatimSearch extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nominatim-search';
    }
}
