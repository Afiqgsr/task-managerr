<?php

use App\Http\Controllers\api\authController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TaskController;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Protected routes with roles and permissions
    Route::middleware(['role:admin'])->group(function () {
        Route::post('Task', [TaskController::class, 'store']);
        Route::put('Task/{product}', [TaskController::class, 'update']);
        Route::delete('Task/{product}', [TaskController::class, 'destroy']);
    });
    
    Route::middleware(['permission:view Task'])->group(function () {
        Route::get('Task', [TaskController::class, 'index']);
        Route::get('Task/{product}', [TaskController::class, 'show']);
    });
});