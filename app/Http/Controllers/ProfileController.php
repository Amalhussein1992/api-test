<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            Log::error('User not authenticated');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Log::info('User authenticated', ['user' => $user]);
        return response()->json($user);
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            Log::error('User not authenticated');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Log::info('Validation passed', ['validated' => $validated]);

            $user->update($validated);
            Log::info('User updated', ['user' => $user]);

            return response()->json($user);
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    

}
