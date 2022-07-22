<?php

use App\Http\Controllers\UserController;
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

Route::get('/',[UserController::class,'index'])->name('user.index');
Route::get('/user_create',[UserController::class ,'create'])->name('user.create');
Route::post('/user_create',[UserController::class ,'store'])->name('user.store');
Route::get('/user_delete/{id}',[UserController::class,'destroy'])->name('user.delete');
Route::get('/user_search',[UserController::class,'search'])->name('user.search');
