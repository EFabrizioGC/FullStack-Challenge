<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserService
{
    private const REMEMBER_MINUTES = 60;

    public function __construct(private readonly OpenWeatherService $SDK)
    {
    }

    public function getUserWeather(User $user)
    {
        return Cache::store('redis')->remember($user->email, self::REMEMBER_MINUTES, function () use ($user) {
            return $this->SDK->getWeatherWithCoordinates($user->longitude, $user->latitude);
        });
    }
}
