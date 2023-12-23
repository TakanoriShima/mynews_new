<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostsController; // 追加

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
Route::controller(PostsController::class)->prefix('admin')->group(function() {
    Route::get('posts/create', 'create');
});
//Route::get('XXX', [AAAController::class, 'bbb']);

use App\Http\Controllers\Admin\ProfilesController;

Route::controller(ProfilesController::class)->prefix('admin')->group(function() {
    Route::get('profiles/create', 'create');
    Route::get('profiles/edit', 'edit');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
