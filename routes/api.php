<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// People API Routes - Version 1
Route::prefix('v1')->group(function () {
    // Get all people with pagination
    Route::get('/peoples', [PeopleController::class, 'index']);
    
    // Get a single person by ID
    Route::get('/peoples/{id}', [PeopleController::class, 'show'])->where('id', '[0-9]+');
    
    // Create a new person (returns 405 for mock data)
    Route::post('/peoples', [PeopleController::class, 'store']);
    
    // Update a person (returns 405 for mock data)
    Route::put('/peoples/{id}', [PeopleController::class, 'update'])->where('id', '[0-9]+');
    Route::patch('/peoples/{id}', [PeopleController::class, 'update'])->where('id', '[0-9]+');
    
    // Delete a person (returns 405 for mock data)
    Route::delete('/peoples/{id}', [PeopleController::class, 'destroy'])->where('id', '[0-9]+');
});

// Alternative: Using apiResource (simpler but includes all methods)
// Route::apiResource('v1/peoples', PeopleController::class);