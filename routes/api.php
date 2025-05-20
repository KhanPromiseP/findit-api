<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController; 


// use App\Http\Controllers\Api\AuthController;

// use App\Http\Controllers\Api\PostController;

// Route::controller(AuthController::class)->group(function () {
//     Route::post('register', 'register');
//     Route::post('login', 'login');
    
    // Protected routes (require authentication)
    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::get('profile', 'profile');
    //     Route::post('logout', 'logout');  
    // });
// });
// Route::controller(PostController::class)->group(function () {
//     Route::post('post', 'post');
//     Route::post('find', 'find');
//     Route::delete('delete/{post}', 'destroy');
//     Route::put('/update/{post}', 'update');
// });




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Changed from /users-with-phone-numbers to /users-with-contacts
Route::get('/users-with-contacts', [UserController::class, 'usersWithContacts']);