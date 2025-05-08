<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\PostController;

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    
    // Protected routes (require authentication)
    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::get('profile', 'profile');
    //     Route::post('logout', 'logout');  
    // });
});
Route::controller(PostController::class)->group(function () {
    Route::post('post', 'post');
    Route::post('find', 'find');
});