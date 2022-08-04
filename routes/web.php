<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/', [PostController::class, 'index'])->name('homepage');

Route::controller(PostController::class)->group(function () {
    Route::prefix('post')->group(function () {
        Route::name('post.')->group(function () {
            Route::get('{post}', 'show')->whereNumber('post')->name('show');
            Route::get('create', 'create')->middleware('auth')->name('create');
            Route::post('store', 'store')->middleware('auth')->name('store');
            Route::get('edit/{post}', 'edit')->whereNumber('post')->middleware('auth')->name('edit');
            Route::put('update/{post}', 'update')->whereNumber('post')->middleware('auth')->name('update');
            Route::delete('delete/{post}', 'destroy')->whereNumber('post')->middleware('auth')->name('delete');
        });
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::prefix('comment')->group(function () {
        Route::name('comment.')->group(function () {
            Route::get('{comment}', 'show')->whereNumber('comment')->name('show');
            Route::get('create/{post}', 'create')->whereNumber('post')->middleware('auth')->name('create');
            Route::post('store/{post}', 'store')->whereNumber('post')->middleware('auth')->name('store');
            Route::get('edit/{comment}', 'edit')->whereNumber('comment')->middleware('auth')->name('edit');
            Route::put('update/{comment}', 'update')->whereNumber('comment')->middleware('auth')->name('update');
            Route::delete('delete/{comment}', 'destroy')->whereNumber('comment')->middleware('auth')->name('delete');
        });
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('/', 'index')->middleware(sprintf('role:ROLE_ADMIN', User::ROLE_ADMIN))->name('index');
        });
    });
});