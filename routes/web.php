<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/categories/store', [HomeController::class, 'storeCategories'])->name('categories.store');
Route::get('/categories/edit/{id}', [HomeController::class, 'editCategories'])->name('categories.edit');
Route::put('/categories/update/{id}', [HomeController::class, 'updateCategories'])->name('categories.update');
Route::delete('/categories/delete/{id}', [HomeController::class, 'deleteCategories'])->name('categories.delete');

Route::get('/todos', [HomeController::class, 'getTodos'])->name('todos.get');
Route::post('/todos/store', [HomeController::class, 'storeTodos'])->name('todos.store');
Route::put('/todos/{id}', [HomeController::class, 'updateTodos'])->name('todos.update');
Route::delete('/todos/{id}', [HomeController::class, 'deleteTodo'])->name('todos.delete');
