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
        Route::delete('/delete/{product:id}', [ProductController::class, 'delete'])->name('delete');
        Route::get('/detail/{product:id}', [ProductController::class, 'detail'])->name('detail');
        Route::get('/edit/{product:id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product:id}', [ProductController::class, 'update'])->name('update');
    });

Route::prefix('comments')
    ->name('comment.')
    ->group(function () {
        Route::post('/{product:id}/save', [CommentController::class, 'save'])->name('save');
    });

Route::prefix('categories')
    ->name('category.')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/save', [CategoryController::class, 'save'])->name('save');
        Route::delete('/delete/{category:id}', [CategoryController::class, 'delete'])->name('delete');
        Route::get('/edit/{category:id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category:id}', [CategoryController::class, 'update'])->name('update');
    });

Route::prefix('carts')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:id}', [CartController::class, 'add'])->name('add');
        Route::post('/clear', [CartController::class, 'clearCart'])->name('clear');
    });
