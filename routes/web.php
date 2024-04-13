<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CustomAuthController;
Route::group(['namespace' => 'App\Http\Controllers'], function()
{ 
Route::get('/', function () {
    return view('home');
});
Route::get('/books', [BookController::class, 'index']);
Route::group(['middleware' => ['guest']], function() {
    Route::get('/login_register', [LoginController::class,'index'] );
    Route::post('/login', [LoginController::class,'login'] )->name('login');
    Route::get('/login_register', [RegisterController::class,'index'] );
    Route::post('/register', [RegisterController::class,'store'] )->name('register');
});
   
    Route::group(['middleware' => ['auth']], function() {
            Route::get('/dashboard', function () {
                return view('dashboard');
            });
            
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});