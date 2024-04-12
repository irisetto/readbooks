<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('home');
});
Route::get('/books', [BookController::class, 'index']);
Route::get('/login_register', [LoginController::class,'index'] );
Route::get('/login_register', [RegisterController::class,'index'] );
