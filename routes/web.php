<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\Index\HomeController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\CommentController;
use App\Http\Controllers\CMS\SearchController;
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
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('', [HomeController::class, 'index'])->name('home.index');

Route::prefix('user')->group(function (){
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
});

Route::post('/comment', [CommentController::class, 'addComment'])->name('comment.add');

Route::prefix('post')->group(function () {
    Route::post('create', [PostController::class, 'create'])->name('post.create');
    Route::get('detail/{id}', [AuthController::class, 'login'])->name('post.detail');
    Route::post('delete/{id}', [AuthController::class, 'login'])->name('post.delete');
    Route::post('restore/{id}', [AuthController::class, 'login'])->name('post.restore');
});

Route::prefix('search')->group(function () {
    Route::get('/user', [SearchController::class, 'searchUserByName'])->name('search.user');
});