<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PoemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| Phase 1: routes wired to controllers, actions to be implemented in Phase 2.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/poems', [PoemController::class, 'index'])->name('poems.index');
Route::get('/poems/{poem:slug}', [PoemController::class, 'show'])->name('poems.show');

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{genre:slug}', [GenreController::class, 'show'])->name('genres.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

/*
|--------------------------------------------------------------------------
| Auth Routes (from Breeze) + Admin Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';   // provided by Breeze
require __DIR__.'/admin.php';
