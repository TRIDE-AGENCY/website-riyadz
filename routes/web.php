<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('/', User\MainController::class)->name('index');
    Route::post('/messages', [User\MainController::class, 'message'])->name('message');
    
    Route::get('/blogs', [User\BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{blog}', [User\BlogController::class, 'show'])->name('blogs.show');

    Route::get('/books', [User\BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [User\BookController::class, 'show'])->name('books.show');
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', Admin\DashboardController::class)->name('dashboard');

        Route::controller(Admin\BlogController::class)->name('blogs.')->group(function () {
            Route::get('/blogs', 'index')->name('index');
            Route::get('/blogs/create', 'create')->name('create');
            Route::post('/blogs', 'store')->name('store');
            Route::get('/blogs/{blog}/edit', 'edit')->name('edit');
            Route::put('/blogs/{blog}', 'update')->name('update');
            Route::delete('/blogs/{blog}', 'destroy')->name('destroy');
        });

        Route::controller(Admin\BookController::class)->name('books.')->group(function () {
            Route::get('/books', 'index')->name('index');
            Route::get('/books/create', 'create')->name('create');
            Route::post('/books', 'store')->name('store');
            Route::get('/books/{book}/edit', 'edit')->name('edit');
            Route::put('/books/{book}', 'update')->name('update');
            Route::delete('/books/{book}', 'destroy')->name('destroy');
        });

        Route::controller(Admin\MessageController::class)->name('messages.')->group(function () {
            Route::get('/messages', 'index')->name('index');
            Route::put('/messages/{message}', 'update')->name('update');
            Route::delete('/messages/{message}', 'destroy')->name('destroy');
        });

        Route::controller(Admin\SettingController::class)->name('settings.')->group(function () {
            Route::get('/settings', 'index')->name('index');
            Route::put('/settings', 'update')->name('update');
        });

        Route::controller(Admin\AccountController::class)->name('account.')->group(function () {
            Route::get('/account', 'index')->name('index');
            Route::put('/account/{account}', 'update')->name('update');
        });
    });
});
