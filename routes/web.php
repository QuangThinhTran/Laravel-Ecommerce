<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\Index\HomeController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\CommentController;
use App\Http\Controllers\CMS\SearchController;
use App\Http\Controllers\Index\DashboardController;
use App\Http\Controllers\CMS\FollowController;

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

    Route::get('not-found', [RedirectController::class, 'notFound'])->name('not.found');
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::prefix('user')->group(function () {
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
});

Route::prefix('post')->group(function () {
    Route::post('create', [PostController::class, 'create'])->name('post.create');
    Route::get('delete', [PostController::class, 'delete'])->name('post.delete');
});

Route::prefix('search')->group(function () {
    Route::get('/user', [SearchController::class, 'searchUserByName'])->name('search.user');
});

Route::prefix('search')->group(function () {
    Route::get('/user', [SearchController::class, 'searchUserByName'])->name('search.user');
});

Route::get('follow/{user}', [FollowController::class, 'follow'])->name('follow');
Route::get('unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::middleware('admin')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::post('/comment', [CommentController::class, 'addComment'])->name('comment.add');