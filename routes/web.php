<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Database\Seeders\TaskSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\Category_taskSeeder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "web" middleware group.
|--------------------------------------------------------------------------
*/

// -------------------------
// 📌 Tasks
// -------------------------
Route::get('/', [ToDoController::class, 'index'])->name('index');
Route::post('/', [ToDoController::class, 'search']);

Route::middleware('Auth')->group(function () {
    Route::get('/create', [ToDoController::class, 'create']);
    Route::post('/create', [ToDoController::class, 'store']);

    Route::get('/edit/{id}', [ToDoController::class, 'edit'])->where('id', '[0-9]+');
    Route::post('/edit/{id}', [ToDoController::class, 'update']);

    Route::get('/delete/{id}', [ToDoController::class, 'destroy'])->where('id', '[0-9]+');
    Route::get('/complete/{id}', [ToDoController::class, 'complete'])->where('id', '[0-9]+');
});

// -------------------------
// ⚙️ Settings & Seeders (dev/test only)
// -------------------------
Route::middleware('Auth')->group(function () {
    Route::get('/d', [ToDoController::class, 'd']);
    Route::get('/dd', [CategoryController::class, 'd'])->name('dd');

    Route::get('/c/{num}', [TaskSeeder::class, 'run'])->where('num', '[0-9]+');
    Route::get('/cc/{num}', [CategorySeeder::class, 'run'])->where('num', '[0-9]+')->name('cc');
    Route::get('/ccc', [Category_taskSeeder::class, 'run'])->name('ccc');

    Route::get('/test', [ToDoController::class, 'test']);
});

// -------------------------
// 🗂️ Categories
// -------------------------
Route::prefix('/categories')->middleware('Auth')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');

    Route::get('/create', [CategoryController::class, 'create']);
    Route::post('/create', [CategoryController::class, 'store']);

    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->where('id', '[0-9]+');
    Route::post('/edit/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');

    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
});

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

// Optional redirect helpers
Route::redirect('/login', '/auth/login');
Route::redirect('/register', '/auth/register');
Route::redirect('/logout', '/auth/logout');

// -------------------------
// 🧭 Fallback Route
// -------------------------
Route::fallback(function () {
    return view('fallback');
});
