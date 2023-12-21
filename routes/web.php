<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RedirectController;
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

