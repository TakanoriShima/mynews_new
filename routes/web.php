<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostsController; // 追加
use App\Http\Controllers\Admin\ProfilesController; // 追加

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

Route::get('/', function () {
    return view('welcome');
});


// 以下追加
Route::controller(PostsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('posts/create', 'create')->name('posts.create');
    Route::post('posts/store', 'store')->name('posts.store');
    Route::get('posts', 'index')->name('posts.index');
    Route::get('posts/{id}/edit', 'edit')->name('posts.edit');
    Route::post('posts/update', 'update')->name('posts.update');
    Route::get('posts/{id}/destroy', 'destroy')->name('posts.destroy');
});

//Route::get('XXX', [AAAController::class, 'bbb']);

Route::controller(ProfilesController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('profiles/create', 'create')->name('profiles.create');
    Route::post('profiles/store', 'store')->name('profiles.store');
    Route::get('profiles/{id}/edit', 'edit')->name('profiles.edit');
    Route::post('profiles/update', 'update')->name('profiles.update');
    Route::get('profiles', 'index')->name('profiles.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
