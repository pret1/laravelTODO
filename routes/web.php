<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, TasksController, TodolistController};


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

Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('postLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [UserController::class, 'postRegister'])->name('postRegister');
Route::get('/forgot-password', [UserController::class, 'showForgot'])->name('password.request');
Route::post('/forgot-password', [UserController::class, 'postForgot'])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'passwordReset'])->name('password.reset');
Route::post('/reset-password', [UserController::class, 'postForgotUpdate'])->name('password.update');
//Route::get('/reset-password', [UserController::class, 'getForgotUpdate']);

Route::get('/', [TasksController::class, 'index'])->name('index')->middleware('auth');
Route::get('/task', [TasksController::class, 'getTask'])->name('getTask')->middleware('auth');

Route::post('/', [TaskSController::class, 'store'])->name('store')->middleware('auth');
