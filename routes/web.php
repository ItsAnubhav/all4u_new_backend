<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::resource('/users', UserController::class);
    Route::put('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.status');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
