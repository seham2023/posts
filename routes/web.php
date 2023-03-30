<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleLoginController;

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
})->name('home');

Route::group(['middleware'=>'auth'],function(){

    Route::resource('posts',PostController::class);
    Route::resource('comments',CommentController::class);
    Route::resource('replies',ReplyController::class);


});



Route::get('login',[LoginController::class,'show_login'])->name('showlogin');
Route::get('register',[AuthController::class,'show_register'])->name('showregister');
Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[LoginController::class,'login'])->name('login');


Route::get('/login/google',[ GoogleLoginController::class,'redirect'])->name('login.google-redirect');
Route::get('/login/google/callback', [ GoogleLoginController::class,'callback'])->name('login.google-callback');
