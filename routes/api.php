<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartitionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

// Authentication Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {

    // User Routes
    Route::get('/user', [UserController::class, 'index']);
    
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('cats', [CategoryController::class, 'index']);
        Route::post('cats', [CategoryController::class, 'store']);
        Route::get('cats/{id}', [CategoryController::class, 'show']); // Ensure this route matches your test
        Route::post('cats/{id}', [CategoryController::class, 'update']); // Ensure this route matches your test
        Route::delete('cats/{id}', [CategoryController::class, 'destroy']);
    });

// User Profile Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user/profile', [ProfileController::class, 'show']);
    Route::post('user/profile/update', [ProfileController::class, 'update']);
});


    // Public Routes (Accessible without authentication)
    Route::get('/get-cats', [UserController::class, 'getCategories']);

    // Resource Routes
    Route::apiResource('partitions', PartitionController::class);
    Route::get('partitions/{partition}/items', [PartitionController::class, 'items']);
    Route::apiResource('items', ItemController::class);
});

