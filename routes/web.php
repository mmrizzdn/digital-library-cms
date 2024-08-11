<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('index');

// Authentication user (guset)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

// Authenticated user
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Category
    Route::post('/dashboard/categories', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::put('/dashboard/categories', [CategoryController::class, 'updateCategory'])->name('update.category');
    Route::delete('/dashboard/categories', [CategoryController::class, 'deleteCategory'])->name('delete.category');

    // // Book
    Route::post('/dashboard/books', [BookController::class, 'addBook'])->name('add.book');
    Route::put('/dashboard/books/{id}', [BookController::class, 'updateBook'])->name('update.book');
    Route::delete('/dashboard/books/{id}', [BookController::class, 'deleteBook'])->name('delete.book');
    Route::get('/dashboard/books/export', [BookController::class, 'exportBook'])->name('export.book'); 
});

