<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testGetProfile()
    {
        $response = $this->actingAs($this->user)->get('/api/user/profile');
        $response->assertStatus(200);
    }

    public function testUpdateProfile()
    {
        $updateData = ['name' => 'Updated Name'];
        $response = $this->actingAs($this->user)->post('/api/user/profile/update', $updateData);

        $response->assertStatus(200);
        $response->assertJson(['name' => 'Updated Name']);
    }

    
    
    

}
