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
use App\Http\Controllers\CMS\PivotTableController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\AttributeController;

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

    Route::get('list-product', [RedirectController::class, 'products'])->name('redirect.products');

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
    Route::get('detail/{id}', [PostController::class, 'detail'])->name('post.detail');
    Route::get('delete', [PostController::class, 'delete'])->name('post.delete');
});

Route::prefix('category')->group(function () {
    Route::get('list', [CategoryController::class, 'index'])->name('category.list');
});

Route::prefix('attribute')->group(function () {
    Route::get('create', [AttributeController::class, 'create'])->name('attribute.create');
    Route::post('store', [AttributeController::class, 'store'])->name('attribute.store');
//    Route::post('detail/{id}', [AttributeController::class, 'detail'])->name('attribute.detail');
});

Route::prefix('attribute-child')->group(function () {
    Route::get('create-child', [AttributeController::class, 'createChild'])->name('attribute.child.create');
    Route::post('store-child', [AttributeController::class, 'storeChild'])->name('attribute.child.store');
    Route::get('detail', [AttributeController::class, 'detailChild'])->name('attribute.child.detail');
});

Route::prefix('product')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::post('detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
});

Route::prefix('search')->group(function () {
    Route::get('/user', [SearchController::class, 'searchUserByName'])->name('search.user');
});

Route::get('follow/{user}', [PivotTableController::class, 'follow'])->name('follow');
Route::get('unfollow/{user}', [PivotTableController::class, 'unfollow'])->name('unfollow');

Route::controller(CommentController::class)->group(function () {
    Route::post('add-comment-child', 'addCommentChild')->name('comment.add.child');
});

Route::middleware('admin')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::post('/comment', [CommentController::class, 'addComment'])->name('comment.add');
