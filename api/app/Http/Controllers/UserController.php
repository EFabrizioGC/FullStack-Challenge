<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function __invoke()
    {
        $users = User::query()->paginate(10);

        foreach ($users as $user) {
            $user->weather = $this->userService->getUserWeather($user);
        }

        return response()->json($users);
    }
}
