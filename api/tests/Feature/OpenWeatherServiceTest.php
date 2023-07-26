<?php

namespace Tests\Feature;

use App\Services\OpenWeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

class OpenWeatherServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_returns_users()
    {
        $json = file_get_contents('tests/Fixtures/openweather-response.json');

        $mock = new MockHandler([
            new Response(200, [], $json),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $openWeatherService = new OpenWeatherService($client);

        $response = $openWeatherService->getWeatherWithCoordinates(10.99, 44.34);

        $this->assertEquals($response, json_decode($json, true));
    }
}
