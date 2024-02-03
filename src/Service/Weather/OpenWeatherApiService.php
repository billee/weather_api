<?php

namespace App\Service\Weather;

use Cake\Http\Client;

class OpenWeatherApiService
{
    public function getWeather(String $url)
    {
        $http = new Client();
        $apiKey = getenv('OPEN_WEATHER_MAP_API_KEY');
        $response = $http->get($url . '&appid='. $apiKey );

        return $response->getJson();
    }
}
