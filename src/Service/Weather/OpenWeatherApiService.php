<?php

namespace App\Service\Weather;

use Cake\Http\Client;
use App\Service\Weather\Interfaces\WeatherApiServiceInterface;

class OpenWeatherApiService implements WeatherApiServiceInterface
{
    private $http;

    public function __construct(Client $http)  // this has to be here so the test will pass. do some more research
    {
        $this->http = $http;
    }

    public function getWeather(String $url)
    {
        //$http = new Client();
        $apiKey = getenv('OPEN_WEATHER_MAP_API_KEY');
        $response = $this->http->get($url . '&appid='. $apiKey );

        return $response->getJson();
    }
}
