<?php

use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/unprotected', function () {
    return response()->json(['message' => 'Non-protected route']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::delete('delete', [AuthController::class, 'delete']);
    Route::get('/protected', function () {
        return response()->json(['message' => 'Protected route']);
    });
    Route::apiResource('task-categories', TaskCategoryController::class);
});

Route::middleware(['auth:api', 'can:isAdmin'])->group(function () {
    Route::post('users/{id}/set-role', [UserController::class, 'setRole']);
});
