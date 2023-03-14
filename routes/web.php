<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BookController::class, 'index']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home'); 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
    Route::delete('/home/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('home.destroy');
    Route::resource('/add', BookController::class);
    Route::get('/add/{id}/edit', [BookController::class, 'edit'])->name('add.edit');
    Route::put('/add/{id}/update', [BookController::class, 'update'])->name('add.update');
});




