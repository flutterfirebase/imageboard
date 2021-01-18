<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ThreadController;
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

Route::get('{board}', [BoardController::class, 'index'])->name('board');
Route::post('{board}', [BoardController::class, 'thread'])->name('new-thread');

Route::get('{board}/{thread}', [ThreadController::class, 'index'])->name('thread');
Route::post('{board}/{thread}', [ThreadController::class, 'reply'])->name('new-reply');

Route::get('/', [IndexController::class, 'index'])->name('index');