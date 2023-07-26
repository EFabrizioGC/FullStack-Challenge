<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

final class OpenWeatherService
{
    private Client $client;
    private string $apiKey;
    private const BASE_URL = 'https://api.openweathermap.org';

    public function __construct(Client $client = null)
    {
        $this->client = new Client(['base_uri' => self::BASE_URL]);
        $this->apiKey = config('services.open-weather.key');

        if ($client) {
            $this->client = $client;
        }
    }

    public function getWeatherWithCoordinates(string $long, string $lat): array
    {
        try {
            $response = $this->client->get("/data/2.5/weather?lat={$lat}&lon={$long}&appid={$this->apiKey}");

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
        }

        return [];
    }
}
