<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserWeatherController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function __invoke(User $user)
    {
        return response()->json($this->userService->getUserWeather($user));
    }
}
