<?php

namespace Database\Seeders;

use App\Console\Commands\CacheUsersWeatherCommand;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(20)->create();

        Artisan::call(CacheUsersWeatherCommand::class);
    }
}
