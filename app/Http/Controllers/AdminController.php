<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    //
    public function getCategories() {
        return response()->json(Category::all());
    }

    public function addCategory(Request $request) {
        // Validate and add a new category
    }

    public function viewCategory($id) {
        return response()->json(Category::findOrFail($id));
    }

    public function editCategory(Request $request, $id) {
        // Validate and update category
    }

    public function deleteCategory($id) {
        // Delete category
    }
}
