<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PoemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| All routes below require an authenticated (admin) user.
| Phase 1: routes wired to controllers, actions to be implemented in Phase 2.
*/

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('poems', PoemController::class)->except(['show']);
        Route::resource('genres', GenreController::class)->except(['show']);
    });
