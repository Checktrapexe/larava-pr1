<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome')->name(name: 'home');

Route::view('/about', 'about')->name(name: 'about');

Route::view('/contact', 'contact')->name(name: 'contact');;

Route::resource('/characters', CharacterController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


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
