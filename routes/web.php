<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;


Route::get('/characters/{character}/image', [CharacterController::class, 'image'])
    ->name('characters.image');

Route::view('/', 'welcome')->name(name: 'home');

Route::view('/about', 'about')->name(name: 'about');

Route::view('/contact', 'contact')->name(name: 'contact');;

Route::resource('/characters', CharacterController::class);

Route::resource('/characters', CharacterController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('/characters', CharacterController::class)
    ->only(['index', 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/auth', \App\Http\Controllers\Auth\AuthenticatedSessionController::class);

Route::patch('/characters/{character}/toggle', [CharacterController::class, 'toggle'])
    ->middleware('auth')
    ->name('characters.toggle');

//self insert-------------------------------

//use App\Http\Controllers\UserController;
//
//Route::get('/user/{id}', [UserController::class, 'show']);

//------------------------------------------


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
