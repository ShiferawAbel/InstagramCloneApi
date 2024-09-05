<?php

use GuzzleHttp\Middleware;
use Spatie\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiChatController;
use App\Http\Controllers\Api\V1\ApiAuthController;
use App\Http\Controllers\Api\V1\ApiPostController;
use App\Http\Controllers\Api\V1\ApiUserController;
use App\Http\Controllers\Api\V1\ApiCommentController;
use App\Http\Controllers\Api\V1\ApiChatController as V1ApiChatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [ApiUserController::class, 'register']);
Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('v1/posts', ApiPostController::class);
    Route::get('v1/posts/{post}/comments', [ApiPostController::class, 'postComments']);
    Route::post('v1/comments/{post}', [ApiCommentController::class, 'store']);
    Route::get('v1/users', [ApiUserController::class, 'index']);
    Route::get('v1/user', [ApiUserController::class, 'auth_profile']);
    Route::get('v1/user/{user}', [ApiUserController::class, 'show']);
    Route::post('v1/follow/{user}', [ApiUserController::class, 'follow']);
    Route::post('v1/unfollow/{user}', [ApiUserController::class, 'unfollow']);
    Route::get('v1/chats', [V1ApiChatController::class, 'index']);
});
Route::middleware(['web', 'auth:sanctum'])->post('/logout', [ApiAuthController::class, 'logout']);