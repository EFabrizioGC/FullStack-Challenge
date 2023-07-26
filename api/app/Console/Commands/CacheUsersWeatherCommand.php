<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\OpenWeatherService;
use App\Services\UserService;
use Illuminate\Console\Command;

class CacheUsersWeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to cache all the users weather in order to retrieve it faster.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::query()->get();
        $userService = new UserService(new OpenWeatherService());


        foreach ($users as $user) {
            $userService->getUserWeather($user);
        }
    }
}
