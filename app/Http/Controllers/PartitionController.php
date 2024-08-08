<?php

// app/Http/Controllers/PartitionController.php
namespace App\Http\Controllers;

use App\Models\Partition;
use App\Models\Category;
use Illuminate\Http\Request;

class PartitionController extends Controller
{
    public function index()
    {
        return Partition::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $partition = Partition::create($request->all());

        return response()->json($partition, 201);
    }

    public function show($id)
    {
        return Partition::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id'
        ]);

        $partition = Partition::findOrFail($id);
        $partition->update($request->all());

        return response()->json($partition, 200);
    }

    public function destroy($id)
    {
        $partition = Partition::findOrFail($id);
        $partition->delete();

        return response()->json(null, 204);
    }

    // Custom endpoint: Extract all partitions for a given category
    public function getPartitionsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return $category->partitions;
    }
}
