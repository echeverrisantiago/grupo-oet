<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/informes', [App\Http\Controllers\ReportsController::class, 'index'])->name('informes.index');
Route::get('/informes/{id}', [App\Http\Controllers\ReportsController::class, 'show'])->name('informes.show');
Route::put('/informes/{vehicle}', [App\Http\Controllers\ReportsController::class, 'update'])->name('informes.update');
Route::delete('/informes/{vehicle}', [App\Http\Controllers\ReportsController::class, 'destroy'])->name('informes.destroy');
Route::post('/informes', [App\Http\Controllers\ReportsController::class, 'store'])->name('informes.store');
Route::get('/workers', [App\Http\Controllers\WorkersController::class, 'index'])->name('workers.index');
Route::post('/workers', [App\Http\Controllers\WorkersController::class, 'store'])->name('workers.store');
Route::get('/workers/{id}', [App\Http\Controllers\WorkersController::class, 'show'])->name('workers.show');
Route::put('/workers/{worker}', [App\Http\Controllers\WorkersController::class, 'update'])->name('workers.update');
Route::delete('/workers/{worker}', [App\Http\Controllers\WorkersController::class, 'destroy'])->name('workers.destroy');