# Laravel Nominatim Search

This a very basic Laravel component for quickly geocoding an address using OpenStreet [Map Nominatim](https://nominatim.openstreetmap.org/) with caching

## Usage

After installing the package, you can use the `NominatimSearch` facade to geocode an address. This is automatically added by the service provider.

```php
use StevenBraham\NominatimSearch\Facades\NominatimSearch;

$address = '1600 Amphitheatre Parkway, Mountain View, CA';

// $location is an array with values 'lat' and 'lon' or null if the address could not be found
$location = NominatimSearch::encodeAddress($address);

```