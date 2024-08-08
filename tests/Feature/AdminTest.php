<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['is_admin' => true]);
        $this->user = User::factory()->create();
    }

    
    public function testGetCategories()
    {
        $response = $this->actingAs($this->admin, 'sanctum')->get('/api/admin/cats');
        $response->assertStatus(200);
    }
    


    public function testAddCategory()
    {
        $response = $this->actingAs($this->admin, 'sanctum')->post('/api/admin/cats', [
            'name_en' => 'New Category in English',
            'name_ar' => 'فئة جديدة بالعربية',
            'description_en' => 'Description in English',
            'description_ar' => 'وصف بالعربية',
        ]);
        
        $response->assertStatus(201);
    }

    public function testViewCategory()
    {
        // Act as the authenticated admin
        $category = Category::factory()->create(); // Ensure the category exists
    
        $response = $this->actingAs($this->admin)->get("/api/admin/cats/{$category->id}");
    
        // Assert that the status is OK
        $response->assertStatus(200);
    
        // Assert that the response contains the category details
        $response->assertJson([
            'id' => $category->id,
            'name_en' => $category->name_en,
            'name_ar' => $category->name_ar,
            'description_en' => $category->description_en,
            'description_ar' => $category->description_ar,
        ]);
    }
    

    public function testEditCategory()
{
    // Act as the authenticated admin
    $category = Category::factory()->create(); // Ensure the category exists

    $updatedData = [
        'name_en' => 'Updated Name EN',
        'name_ar' => 'Updated Name AR',
        'description_en' => 'Updated Description EN',
        'description_ar' => 'Updated Description AR'
    ];

    $response = $this->actingAs($this->admin)->post("/api/admin/cats/{$category->id}", $updatedData);

    // Assert that the status is OK
    $response->assertStatus(200);

    // Assert that the category was updated in the database
    $this->assertDatabaseHas('categories', array_merge(['id' => $category->id], $updatedData));
}

    public function testDeleteCategory()
    {
        // Act as the authenticated admin
        $category = Category::factory()->create(); // Ensure the category exists
    
        $response = $this->actingAs($this->admin)->delete("/api/admin/cats/{$category->id}");
    
        // Assert that the status is OK
        $response->assertStatus(204); // 204 is the standard status code for successful deletion
    
        // Assert that the category was deleted from the database
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
