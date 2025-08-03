<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/threads')->name('home');

Route::get("/threads", [ThreadController::class, 'index'])->name('threads.index');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');


Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store'])->name('login.store');
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
