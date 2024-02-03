<?php

namespace App\Test\Service\Weather;

use App\Service\Weather\OpenWeatherApiService;
use Cake\Http\Client;
use Cake\Http\Client\Response;
use PHPUnit\Framework\TestCase;

class OpenWeatherApiServiceTest extends TestCase
{
    public function testGetWeather()
    {
        $mockResponse = $this->createMock(Response::class);
        $mockResponse->method('getJson')->willReturn(['weather' => 'sunny']);

        $mockClient = $this->createMock(Client::class);
        $mockClient->method('get')->willReturn($mockResponse);

        $service = new OpenWeatherApiService($mockClient);

        $result = $service->getWeather('http://aaa.com'); // aaa.com is just a placeholder

        $this->assertEquals(['weather' => 'sunny'], $result);
    }
}

//comment
//to run this test, use  ./vendor/bin/phpunit tests/Service/Weather/OpenWeatherApiServiceTest.php
