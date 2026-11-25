<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/locale/{locale}', LocaleController::class)->name('locale.switch');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin,editor')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', AdminProductController::class)->except(['show']);
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update', 'destroy']);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
