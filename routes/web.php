<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'welcome']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::post('/posts/search', [PostController::class, 'search']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/my-posts', [PostController::class, 'myPosts'])->middleware('auth');
Route::get('/admin', [PostController::class, 'unpublishedPosts'])->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->middleware('auth');
Route::post('posts/{post}/publish', [PostController::class, 'publish'])->middleware('auth');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->middleware('auth');
Route::patch('posts/{post}', [PostController::class, 'update'])->middleware('auth');

Route::get('/signup', [RegisterUserController::class, 'create']);
Route::post('/signup', [RegisterUserController::class, 'store']);
Route::get('/edit_user/{user}', [RegisterUserController::class, 'edit'])->middleware('auth')->can('edit', 'user');
Route::post('/edit_user/{user}', [RegisterUserController::class, 'update'])->middleware('auth')->can('edit', 'user');
Route::get('/promotion/{user}', [RegisterUserController::class, 'promotion']);
Route::get('/removeadmin/{user}', [RegisterUserController::class, 'removeadmin']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth');
Route::post('/posts/{post}', [CommentController::class, 'store'])->middleware('auth');
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->middleware('auth');
Route::get('/authors', [PostController::class, 'authors']);
Route::get('/authors/{user}', [PostController::class, 'author']);
