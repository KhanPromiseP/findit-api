<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\Api\PostController;
=======
>>>>>>> 4992f2abefae08f84c68f32dd98038c5c55659e5

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    
    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('profile', 'profile');
        Route::post('logout', 'logout');  
    });
<<<<<<< HEAD
});
Route::controller(PostController::class)->group(function () {
    Route::post('post', 'post');
=======
>>>>>>> 4992f2abefae08f84c68f32dd98038c5c55659e5
});