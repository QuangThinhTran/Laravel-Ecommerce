<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\AttributeController;
use App\Http\Controllers\CMS\CartController;
use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\CommentController;
use App\Http\Controllers\CMS\OrderController;
use App\Http\Controllers\CMS\PostController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\CMS\SearchController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\Index\DashboardController;
use App\Http\Controllers\Index\HomeController;
use App\Http\Controllers\Index\MerchantController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\Index\CustomerController;
use App\Http\Controllers\CMS\TermController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('term')->group(function () {
    Route::get('create', [TermController::class, 'create'])->name('term.create');
    Route::post('store', [TermController::class, 'store'])->name('term.store');
    Route::get('detail', [TermController::class, 'detail'])->name('term.detail');
});

Route::prefix('product')->group(function () {
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::post('detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
});

Route::prefix('cart')->group(function () {
    Route::get('create', [CartController::class, 'create'])->name('cart.create');
    Route::post('store', [CartController::class, 'store'])->name('cart.store');
    Route::get('detail/{id}', [CartController::class, 'detail'])->name('cart.detail');
});

Route::prefix('order')->group(function () {
    Route::get('list', [OrderController::class, 'index'])->name('order.list');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
});

Route::prefix('merchant')->group(function () {
    Route::get('employees', [MerchantController::class, 'getEmployees'])->name('merchant.employees');
    Route::post('add-employees', [MerchantController::class, 'createEmployees'])->name('merchant.create.employees');
});

Route::prefix('customer')->group(function () {
    Route::get('index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('products', [CustomerController::class, 'getProducts'])->name('customer.products');
    Route::get('carts', [CustomerController::class, 'getCarts'])->name('customer.carts');
});


Route::prefix('search')->group(function () {
    Route::get('/user', [SearchController::class, 'searchUserByName'])->name('search.user');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('add-comment-child', 'addCommentChild')->name('comment.add.child');
});

Route::middleware('admin')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::post('/comment', [CommentController::class, 'addComment'])->name('comment.add');
