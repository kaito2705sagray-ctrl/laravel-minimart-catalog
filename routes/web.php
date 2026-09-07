<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\RedisPubSubHandler;
use PhpParser\Node\Stmt\GroupUse;

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [ProductController::class, 'index'])->name('index');

    Route::group(['prefix' => 'section', 'as' => 'section.'], function(){

        Route::get('/index', [SectionController::class, 'index'])->name('index');

        Route::post('/store', [SectionController::class, 'store'])->name('store');

        Route::delete('/{id}/delete', [SectionController::class, 'delete'])->name('delete');

        Route::get('/{id}/edit', [SectionController::class, 'edit'])->name('edit');

        Route::patch('/{id}/update', [SectionController::class, 'update'])->name('update');

    });

    Route::group(['prefix' => 'product' , 'as' => 'product.'], function(){

        Route::get('/create', [ProductController::class, 'create'])->name('create');

        Route::post('/store', [ProductController::class, 'store'])->name('store');

        Route::delete('/{id}/delete', [ProductController::class, 'delete'])->name('delete');

        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');

        Route::patch('/{id}/update', [ProductController::class, 'update'])->name('update');

        Route::patch('/{id}/buy', [ProductController::class, 'buy'])->name('buy');

    });
});
