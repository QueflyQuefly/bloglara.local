<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::controller(PostController::class)->group(function () {
    
    Route::get('/', 'index')->name('homepage');

    Route::prefix('post')->group(function () {
        Route::name('post.')->group(function () {

            Route::get('{post}', 'show')->whereNumber('post')->name('show');

            Route::middleware('auth')->group(function () {
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{post}', 'edit')->whereNumber('post')->name('edit');
                Route::put('update/{post}', 'update')->whereNumber('post')->name('update');
                Route::delete('delete/{post}', 'destroy')->whereNumber('post')->name('delete');
            });
        });
    });
});

Route::controller(CommentController::class)->group(function () {
    Route::prefix('comment')->group(function () {
        Route::name('comment.')->group(function () {

            Route::get('{comment}', 'show')->whereNumber('comment')->name('show');

            Route::middleware('auth')->group(function () {
                Route::get('create/{post}', 'create')->whereNumber('post')->name('create');
                Route::post('store/{post}', 'store')->whereNumber('post')->name('store');
                Route::get('edit/{comment}', 'edit')->whereNumber('comment')->name('edit');
                Route::put('update/{comment}', 'update')->whereNumber('comment')->name('update');
                Route::delete('delete/{comment}', 'destroy')->whereNumber('comment')->name('delete');
            });
        });
    });
});

Route::controller(AdminController::class)->group(function () {
    Route::middleware(sprintf('role:%s', User::ROLE_ADMIN))->group(function () {
        Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/users', 'showUsers')->name('users');
                Route::get('/posts', 'showPosts')->name('posts');
                Route::get('/comments', 'showComments')->name('comments');
            });
        });
    });
});

Route::controller(UserController::class)->group(function () {
    Route::prefix('user')->group(function () {
        Route::name('user.')->group(function () {
            Route::get('/user/{user}', 'show')->whereNumber('user')->name('show');

            Route::middleware('auth')->group(function () {
                Route::get('edit/{user}', 'edit')->whereNumber('user')->name('edit');
                Route::put('update/{user}', 'update')->whereNumber('user')->name('update');
                Route::delete('delete/{user}', 'destroy')->whereNumber('user')->name('delete');
            });
        });
    });
});