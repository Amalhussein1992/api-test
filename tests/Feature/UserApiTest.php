<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class UserApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function can_fetch_users()
    {
        // Create a test user
        $user = User::factory()->create();

        // Authenticate the test user
        $response = $this->actingAs($user)->get('/api/user');

        // Debug the response
        dd($response->status(), $response->getContent());

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'email']
        ]);
    }

    

}
