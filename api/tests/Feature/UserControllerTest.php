<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_returns_users()
    {
        $user = User::factory()->create();

        $this->json('get', '/users')
            ->assertStatus(Response::HTTP_OK)
            ->assertSee($user->name);
    }
}
