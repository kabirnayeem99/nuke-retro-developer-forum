<?php

use App\Http\Controllers\GeminiController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/threads')->name('home');

Route::get('/generate-sci-fi-thread', [GeminiController::class, 'generateSciFiThread']);

Route::get("/threads", [ThreadController::class, 'index'])->name('threads.index');
Route::post('/threads', [ThreadController::class, 'store'])->middleware('auth')->name('threads.store');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::post('threads/{thread}/reply', [PostController::class, 'store'])->middleware('auth')->name('threads.reply');



Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
