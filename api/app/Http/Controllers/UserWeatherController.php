<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\OpenWeatherService;
use Illuminate\Support\Facades\Cache;

class UserWeatherController extends Controller
{
    private const REMEMBER_MINUTES = 60;

    public function __construct(private readonly OpenWeatherService $SDK)
    {
    }

    public function __invoke(User $user)
    {
        return Cache::store('redis')->remember($user->email, self::REMEMBER_MINUTES, function () use ($user) {
            return response()->json($this->SDK->getWeatherWithCoordinates($user->longitude, $user->latitude));
        });
    }
}
