<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


//public pages

// Home / landing page
Route::get('/', [HomeController::class, 'index'])->name('home');


// About page
Route::view('/about', 'about')->name('about');

// Contact page
Route::view('/contact', 'contact')->name('contact');

//characters

// Serves a character's image file
Route::get('/characters/{character}/image', [CharacterController::class, 'image'])
    ->name('characters.image');

// Create / store / edit / update / destroy (logged in users only)
// !! must be registered BEFORE the public resource, so /characters/create isn't caught by /characters/{character}
Route::resource('characters', CharacterController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

// Overview + detail page of characters (public)
Route::resource('characters', CharacterController::class)
    ->only(['index', 'show']);

// Toggle a character (e.g. visibility/status), logged in users only
Route::patch('/characters/{character}/toggle', [CharacterController::class, 'toggle'])
    ->middleware('auth')
    ->name('characters.toggle');

//comments

// Post a comment on a character
Route::post('/characters/{character}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

// Delete a comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');


// Users

// Public profile page of a user
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');


// Dashboard & Admin (logged in)

// User dashboard (needs login + verified email)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin overview page
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');

//acc settings

Route::middleware('auth')->group(function () {
    // Edit profile form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Save profile changes
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Delete account
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login / register / password reset etc.
require __DIR__ . '/auth.php';
