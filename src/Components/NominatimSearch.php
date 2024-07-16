<?php

namespace StevenBraham\NominatimSearch\Components;

use GuzzleHttp\Client;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\Log;

class NominatimSearch
{
    private Repository $cache;
    private Client $client;

    public function __construct(Repository $cache, Client $client)
    {
        $this->cache = $cache;
        $this->client = $client;
    }

    /**
     * Search for a location by query and returns the latitude and longitude
     * @param string $addres
     * 
     * @return array|null [latitude, longitude] or null if not found
     */
    public function encodeAddress(string $addres): ?array
    {
        $queryUrl = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
            'q' => $addres,
            'format' => 'json',
            'addressdetails' => 0,
            'limit' => 1,
        ]);

        $cacheKey = 'nominatim_' . md5($queryUrl);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }
        try {

            $response = $this->client->get($queryUrl, [
                'headers' => [
                    'User-Agent' => config('app.name'),
                ],
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error('Nominatim search failed: ' . $response->getBody());
                return null;
            }

            $responseBody = json_decode($response->getBody(), true);

            $result = null;

            if (!empty($responseBody[0])) {
                $result = [
                    floatval($responseBody[0]['lat']),
                    floatval($responseBody[0]['lon']),
                ];
            }

            $this->cache->put($cacheKey, $result);

            return $result;
        } catch (\Exception $e) {
            Log::error($e);
            return null;
        }
    }
}
