<?php

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// -------------------------
// 📌 Tasks (Public routes)
// -------------------------
Route::get('/', [ToDoController::class, 'index'])->name('index');
Route::post('/', [ToDoController::class, 'search']);

// Task modification routes (protected with both CheckAuth and HCP)
Route::middleware('CheckAuth')->group(function () {
    Route::middleware('HCP')->group(function () {
// CREATE
        Route::get('/create', [ToDoController::class, 'create']);
        Route::post('/create', [ToDoController::class, 'store']);

// EDIT
        Route::get('/edit/{id}', [ToDoController::class, 'edit'])->where('id', '[0-9]+');
        Route::post('/edit/{id}', [ToDoController::class, 'update']);

// DELETE
        Route::get('/delete/{id}', [ToDoController::class, 'destroy'])->where('id', '[0-9]+');
    });

// Complete action (only CheckAuth, no HCP)
    Route::get('/complete/{id}', [ToDoController::class, 'complete'])->where('id', '[0-9]+');
});

// -------------------------
// 🗂️ Categories (Public index)
// -------------------------

// Category modification routes (protected with both CheckAuth and HCP)
Route::prefix('/categories')->middleware('CheckAuth')->group(function () {
    Route::middleware('HCP')->group(function () {
// INDEX
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');

// CREATE
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/create', [CategoryController::class, 'store']);

// EDIT
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->where('id', '[0-9]+');
        Route::post('/edit/{id}', [CategoryController::class, 'update']);

// DELETE
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
    });
});

// -------------------------
// ⚙️ Settings & Seeders (dev/test only)
// -------------------------
Route::get('/d', [ToDoController::class, 'd']);
Route::get('/dd', [CategoryController::class, 'd'])->name('dd');
Route::get('/c', [DatabaseSeeder::class, 'run'])->where('num', '[0-9]+');
Route::get('/test', [ToDoController::class, 'test']);

// -------------------------
// 🔐 Authentication
// -------------------------
Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.showRegister');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Redirect helpers
Route::redirect('/login', '/auth/login');
Route::redirect('/register', '/auth/register');
Route::redirect('/logout', '/auth/logout');

// Fallback
Route::fallback(function () {
    return view('fallback');
});
