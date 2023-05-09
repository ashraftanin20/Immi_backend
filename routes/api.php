<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/profile', [ProfileController::class, 'editProfile']);
Route::put('/profile/update', [ProfileController::class, 'update']);

Route::get('/posts', [PostController::class, 'posts']);
Route::get('/posts/latest', [PostController::class, 'latestPosts']);
Route::post('/post', [PostController::class, 'post']);
Route::post('/posts/create', [PostController::class, 'createPost']);
Route::get('/categories', [CategoryController::class, 'categories']);
Route::post('/comments/create', [CommentController::class, 'createComment']);
Route::post('/comments', [CommentController::class, 'getComments']);

Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/user', [UserController::class, 'getUser']);

Route::post('/message/send', [MessageController::class, 'createMessage']);

