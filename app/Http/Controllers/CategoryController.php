<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
   // app/Http/Controllers/CategoryController.php

public function index()
{
    return response()->json(Category::all());
}

public function store(Request $request): JsonResponse
{
    // Validate request
    $validated = $request->validate([
        'name_en' => 'required|string|max:255',
        'name_ar' => 'required|string|max:255',
        'description_en' => 'nullable|string',
        'description_ar' => 'nullable|string',
    ]);
     // Create category
     $category = Category::create($validated);

     // Return response
     return response()->json($category, 201);
}

public function update(Request $request, $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        
        return response()->json($category);
    }


    public function show($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    
public function destroy($id): JsonResponse
{
    $category = Category::findOrFail($id);
    $category->delete();
    
    return response()->json(null, 204); // Status code 204 for successful deletion with no content
}

}

