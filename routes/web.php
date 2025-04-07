<?php

use App\Http\Controllers\CategoryController;
use Database\Seeders\Category_taskSeeder;
use Database\Seeders\Category_taskSeeder as Category_taskSeederAlias;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TaskSeeder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//tasks
Route::get('/', [ToDoController::class, 'index'])->name('index');

Route::get('/create', [ToDoController::class, 'create']);
Route::post('/create', [ToDoController::class, 'store']);

Route::get('/edit/{id}', [ToDoController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/edit/{id}', [ToDoController::class, 'update'])->where('id', '[0-9]+');

Route::get('/delete/{id}', [ToDoController::class, 'destroy'])->where('id', '[0-9]+');

Route::get('/complete/{id}', [ToDoController::class, 'complete'])->where('id', '[0-9]+');

Route::post('/', [ToDoController::class, 'search']);
//tasks end

//settings
Route::get('/d', [ToDoController::class, 'd']);
Route::get('/dd', [CategoryController::class, 'd'])->name('dd');

Route::get('/c/{num}', [TaskSeeder::class, 'run'])->where('num', '[0-9]+');
Route::get('/cc/{num}', [CategorySeeder::class, 'run'])->where('num', '[0-9]+')->name('cc');
Route::get('/ccc', [Category_taskSeeder::class, 'run'])->name('ccc');

Route::fallback(function () {
    return view('fallback');
});

Route::get('/test', [ToDoController::class, 'test']);
//settings end

//Categories
Route::prefix('/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('Category.index');

    Route::get('/create', [CategoryController::class, 'create']);
    Route::post('/create', [CategoryController::class, 'store']);

    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->where('id', '[0-9]+');
    Route::post('/edit/{id}', [CategoryController::class, 'update'])->where('id', '[0-9]+');

    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->where('id', '[0-9]+');
});
