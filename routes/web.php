<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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
Route::get('/find/search', [PostController::class, 'find'])->name('find.search');
Route::delete('/images/{image}', [PostController::class, 'destroyImage'])->name('images.destroy');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/admin/pending-posts', [PostController::class, 'pendingPosts'])->name('admin.pending_posts');
//     // Route::patch('/admin/posts/{post}/approve', [PostController::class, 'approvePost'])->name('admin.posts.approve');
//     Route::post('/admin/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
//     Route::post('/admin/posts/{post}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
//     Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
//     Route::get('/admin/contact/{post}', [AdminController::class, 'contactUser'])->name('admin.contact.user');
//     Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
// });





Route::middleware(['auth'])->group(function () { // Ensure only authenticated users can access these
    Route::prefix('admin')->group(function () { // Group all admin routes under the /admin prefix
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // You'll need a controller method to handle pending posts
        Route::get('/pending-posts', [AdminController::class, 'pendingPosts'])->name('admin.pending-posts');
        // And a method for approved posts
        Route::get('/approved-posts', [AdminController::class, 'approvedPosts'])->name('admin.approved-posts');
        // And a method to display users
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

        // You'll also need routes for the other actions in your AdminController,
        // like approving, rejecting, deleting posts, deleting users, etc.
        // Make sure those routes are defined and named appropriately if you intend to link to them.
        Route::post('/posts/{postId}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
        Route::post('/posts/{postId}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
        Route::post('/posts/{postId}/delete', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
        Route::get('/posts/{postId}/contact', [AdminController::class, 'contactUser'])->name('admin.posts.contact');
        Route::delete('/users/{userId}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');


        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

  });



// Admin routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/pending-posts', [PostController::class, 'pendingPosts'])->name('admin.pending_posts');
//     Route::delete('/admin/posts/{post}/reject', [PostController::class, 'rejectPost'])->name('admin.posts.reject');
// });

// routes/api.php
// Route::get('/posts/pending', [PostController::class, 'pendingPosts'])->middleware('auth:api');


require __DIR__.'/auth.php';
