<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('task/order', [TaskController::class, 'order'])->middleware('auth');
Route::get('task/partial/{id}', [TaskController::class, 'getPartial'])->middleware('auth');
Route::resource('task', TaskController::class)->middleware('auth');
Route::resource('project', ProjectController::class)->middleware('auth');
