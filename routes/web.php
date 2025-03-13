<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('boards', BoardController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/boards/{board}/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/boards/{board}/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/boards/{board}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

});
