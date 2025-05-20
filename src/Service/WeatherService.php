<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{

    public function __construct(
        private readonly string $apikey,
        private readonly HttpClientInterface $httpClient
    ) {}

    public function getWeather()
    {
        $response = $this->httpClient->request(
            'GET',
            'https://api.openweathermap.org/data/2.5/weather?q=albi&appid=' . $this->apikey . "&units=metric");
        $data = $response->getContent();
        $data = $response->toArray();
        return $data;
    }

    public function getWeatherByCity(string $city) {
        try {
            $response = $this->httpClient->request(
                'GET',
                'https://api.openweathermap.org/data/2.5/weather?q=' . $city.'&appid=' . $this->apikey . "&units=metric");
            $data = $response->getContent();
            $data = $response->toArray();
        } catch (\Exception $e) {
            $data["cod"] = $e->getCode();
        }
        
        return $data;
    }
}
