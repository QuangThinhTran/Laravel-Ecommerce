<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\CommentController;
use App\Http\Controllers\CMS\PivotController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\CMS\TicketController;
use App\Http\Controllers\Index\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');
});

Route::prefix('post')->middleware('auth:sanctum')->group(function () {
    Route::get('detail/{id}', [PostController::class, 'detail'])->name('post.detail');
    Route::post('create', [PostController::class, 'create'])->name('post.create');
    Route::put('update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('delete/{id}', [PostController::class, 'delete'])->name('post.delete');
});

Route::prefix('pivot')->middleware('auth:sanctum')->group(function () {
    Route::get('follow/{id}', [PivotController::class, 'follow'])->name('pivot.follow');
    Route::get('unfollow/{id}', [PivotController::class, 'unfollow'])->name('pivot.unfollow');
    Route::get('like/{id}', [PivotController::class, 'like'])->name('pivot.like');
    Route::get('unlike/{id}', [PivotController::class, 'unlike'])->name('pivot.unlike');
    Route::get('saved/{id}', [PivotController::class, 'saved'])->name('pivot.saved');
    Route::get('unsaved/{id}', [PivotController::class, 'unsaved'])->name('pivot.unsaved');
});

Route::prefix('comment')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [CommentController::class, 'create'])->name('comment.create');
    Route::put('update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');
});

Route::prefix('ticket')->middleware('auth:sanctum')->group(function () {
    Route::post('create', [TicketController::class, 'create'])->name('report.create');
    Route::put('update/{id}', [TicketController::class, 'update'])->name('report.update');
    Route::delete('delete/{id}', [TicketController::class, 'delete'])->name('report.delete');
});

Route::get('', [HomeController::class, 'index'])->name('home.index');