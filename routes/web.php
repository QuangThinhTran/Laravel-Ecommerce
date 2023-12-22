<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\Index\HomeController;
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
Route::prefix('view')->group(function () {
    Route::get('register', [RedirectController::class, 'register'])->name('redirect.register');
    Route::get('login', [RedirectController::class, 'login'])->name('redirect.login');
    Route::get('index', [RedirectController::class, 'index'])->name('redirect.index');
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::get('', [HomeController::class, 'index'])->name('home.index');

Route::prefix('post')->group(function () {
    Route::post('create', [PostController::class, ''])->name('auth.register');
    Route::get('detail/{id}', [AuthController::class, 'login'])->name('auth.login');
    Route::post('delete/{id}', [AuthController::class, 'login'])->name('auth.login');
    Route::post('restore/{id}', [AuthController::class, 'login'])->name('auth.login');
});