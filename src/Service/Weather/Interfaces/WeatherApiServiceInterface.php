<?php

namespace App\Service\Weather\Interfaces;

interface WeatherApiServiceInterface
{
    public function getWeather(String $url);
}
