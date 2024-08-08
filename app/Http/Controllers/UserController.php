<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class UserController extends Controller
{
    //
    public function index()
    {
        // Fetch users from the database
    $users = User::all();

    // Check if users are fetched
    if ($users->isEmpty()) {
        return response()->json(['message' => 'No users found'], 404);
    }

    // Return users as a JSON response
    return response()->json($users);
    }

    public function getCategories() {
        return response()->json(Category::all());
    }

    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        return response()->json($user);
    }
}
