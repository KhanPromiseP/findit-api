<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    
    // Protected routes (require authentication)
    // Route::middleware('auth:sanctum')->group(function () {
    //     Route::get('profile', 'profile');
    //     Route::post('logout', 'logout');  
    // });
});

// Route::controller(PostController::class)->group(function () {
//     Route::post('post', 'post');
//     Route::post('find', 'find');
// });

Route::resource('posts', PostController::class);
Route::get('/posts/search', [PostController::class, 'find'])->name('posts.search');




Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pending-posts', [PostController::class, 'pendingPosts'])->name('admin.pending_posts');
    // Route::patch('/admin/posts/{post}/approve', [PostController::class, 'approvePost'])->name('admin.posts.approve');
    Route::post('/admin/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
    Route::post('/admin/posts/{post}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::get('/admin/contact/{post}', [AdminController::class, 'contactUser'])->name('admin.contact.user');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});





// Admin routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/pending-posts', [PostController::class, 'pendingPosts'])->name('admin.pending_posts');
//     Route::delete('/admin/posts/{post}/reject', [PostController::class, 'rejectPost'])->name('admin.posts.reject');
// });

// routes/api.php
// Route::get('/posts/pending', [PostController::class, 'pendingPosts'])->middleware('auth:api');


require __DIR__.'/auth.php';
