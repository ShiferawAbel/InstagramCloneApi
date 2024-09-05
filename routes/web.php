<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


Route::get('/', [PostController::class, 'index'])->middleware('auth');
Route::get('/newpost', [PostController::class, 'create'])->middleware('auth');
Route::post('/newpost', [PostController::class, 'store'])->middleware('auth');
Route::get('/post/{post}', [PostController::class, 'show'])->middleware('auth');

// Auth

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/signup', [UserController::class, 'store'])->middleware('guest');

Route::get('/loginform', [UserController::class, 'login_create'])->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout']);

Route::get('/profile/{user}', [UserController::class, 'show'])->middleware('auth');

Route::get('/findfriends', [UserController::class, 'findfriends'])->middleware('auth');
Route::get('/follow/{user}', [UserController::class, 'follow'])->middleware('auth');

Route::get('/startchat/{user}', [ChatController::class, 'startchat'])->middleware('auth');
Route::post('/createchat', [ChatController::class, 'createchat'])->middleware('auth');
Route::get('/chat', [ChatController::class, 'index'])->middleware('auth');
Route::get('/chat/{chat}', [ChatController::class, 'show'])->middleware('auth');

Route::post('/sendmessage', [ChatController::class, 'sendmessage'])->middleware('auth');
Route::post('/comment', [CommentController::class, 'store'])->middleware('auth');
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
