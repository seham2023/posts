<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;

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
    return view('front.createPost');
});
Route::resource('posts',PostController::class);
Route::resource('comments',CommentController::class);
Route::resource('replies',ReplyController::class);


Route::get('login',[AuthController::class,'show_login'])->name('showlogin');
Route::get('register',[AuthController::class,'show_register'])->name('showregister');
Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[LoginController::class,'login'])->name('login');
