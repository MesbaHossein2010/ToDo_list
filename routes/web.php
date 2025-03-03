<?php

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

Route::get('/', [ToDoController::class, 'index'])->name('index');

Route::get('/create', [ToDoController::class, 'create']);
Route::post('/create', [ToDoController::class, 'store']);

Route::get('/edit/{id}', [ToDoController::class, 'edit'])->where('id', '[0-9]+');
Route::post('/edit/{id}', [ToDoController::class, 'update'])->where('id', '[0-9]+');

Route::get('/delete/{id}', [ToDoController::class, 'destroy'])->where('id', '[0-9]+');

Route::get('/complete/{id}', [ToDoController::class, 'complete'])->where('id', '[0-9]+');

Route::post('/', [ToDoController::class, 'search']);

Route::get('/d', function () {
    session()->flush();
});

Route::fallback(function (){
    return view('fallback');
});
