<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function __invoke() {
        return response()->json(User::query()->paginate(10));
    }
}
