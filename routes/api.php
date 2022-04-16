<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Product Controller Routes
Route::group(['prefix' => 'products', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ProductController::class, 'index']);
});
