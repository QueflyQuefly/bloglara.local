<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{post}', 'edit')->whereNumber('post')->name('edit');
            Route::put('update/{post}', 'update')->whereNumber('post')->name('update');
            Route::delete('delete/{post}', 'destroy')->whereNumber('post')->name('delete');
        });
    });
});