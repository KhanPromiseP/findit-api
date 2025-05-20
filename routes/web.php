<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\FindController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AdminHelpRequestController;

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
});

Route::get('/posts/mine', [PostController::class, 'mine'])
    ->middleware('auth')
    ->name('posts.mine');

Route::middleware('auth')->group(function () {
Route::resource('posts', PostController::class);  //This is a resource route
// Route::get('/posts/mine', [PostController::class, 'mine'])->name('posts.mine');
Route::get('/find/search', [PostController::class, 'find'])->name('find.search');
Route::get('/find/showsearch/{post}', [PostController::class, 'showsearch'])->name('find.showsearch');
Route::delete('/images/{image}', [PostController::class, 'destroyImage'])->name('images.destroy');

Route::post('/find/help-request', [FindController::class, 'storeHelpRequest'])->name('find.help-request');
});




Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::resource('help-requests', AdminHelpRequestController::class);
    Route::get('/help-requests', [AdminHelpRequestController::class, 'index'])->name('help-requests.index');
    Route::get('/help-requests/{helpRequest}', [AdminHelpRequestController::class, 'show'])->name('help-requests.show');
    Route::put('/help-requests/{helpRequest}', [AdminHelpRequestController::class, 'update'])->name('help-requests.update');
});


Route::middleware(['auth'])->group(function () { 
    Route::prefix('admin')->group(function () { 
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/pending-posts', [AdminController::class, 'pendingPosts'])->name('admin.pending-posts');
        Route::get('/approved-posts', [AdminController::class, 'approvedPosts'])->name('admin.approved-posts');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/posts/{postId}/approve', [AdminController::class, 'approvePost'])->name('admin.posts.approve');
        Route::post('/posts/{postId}/reject', [AdminController::class, 'rejectPost'])->name('admin.posts.reject');
        Route::delete('/posts/{postId}/delete', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
        Route::get('/posts/{postId}/contact', [AdminController::class, 'contactUser'])->name('admin.posts.contact');
        Route::delete('/users/{userId}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');


        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        // Using DELETE method
        Route::delete('/posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.delete');
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
