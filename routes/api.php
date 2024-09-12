<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::prefix('products')
    ->name('product.')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/save', [ProductController::class, 'save'])->name('save');
        Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
        Route::get('/detail/{product}', [ProductController::class, 'detail'])->name('detail');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit')->middleware('auth:sanctum');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
    });

Route::prefix('comments')
    ->name('comment.')
    ->group(function () {
        Route::post('/{product}/save', [CommentController::class, 'save'])->name('save')->middleware('auth:sanctum');
    });

Route::prefix('categories')
    ->name('category.')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/save', [CategoryController::class, 'save'])->name('save');
        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
    });

Route::prefix('carts')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('clear');
    });
