<?php
namespace App\Service\Weather;

use App\Service\Weather\Interfaces\WeatherApiServiceInterface;

class WeatherApiService
{
    private $weatherService;

    public function __construct(WeatherApiServiceInterface $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeather(String $url)
    {
        return $this->weatherService->getWeather($url);
    }
}
