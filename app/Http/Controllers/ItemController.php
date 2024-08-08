<?php

// app/Http/Controllers/ItemController.php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Partition;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'partition_id' => 'required|exists:partitions,id'
        ]);

        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Item::with('partition.category')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'partition_id' => 'sometimes|exists:partitions,id'
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(null, 204);
    }

    // Custom endpoint: Extract all items for a given category
    public function getItemsByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        return $category->items;
    }

    // Custom endpoint: Extract all items for a given partition
    public function getItemsByPartition($partitionId)
    {
        $partition = Partition::findOrFail($partitionId);
        return $partition->items;
    }

    // Custom endpoint: Return details of an item along with its category and partition information
    public function getItemDetails($id)
    {
        return Item::with('partition.category')->findOrFail($id);
    }
}
