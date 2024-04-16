<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MyBooksController;
use App\Http\Controllers\ListController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CustomAuthController;
Route::group(['namespace' => 'App\Http\Controllers'], function()
{ 
Route::get('/', function () {
    return view('home');
});
Route::get('/books', [BookController::class, 'index']);
Route::post('/books/search', [BookController::class, 'search'])->name('search');
Route::get('/books/{book}', [BookController::class, 'showBook'])->name('book.details');

Route::group(['middleware' => ['guest']], function() {
    Route::get('/login_register', [LoginController::class,'index'] );
    Route::post('/login', [LoginController::class,'login'] )->name('login');
    Route::get('/login_register', [RegisterController::class,'index'] );
    Route::post('/register', [RegisterController::class,'store'] )->name('register');
});
   
    Route::group(['middleware' => ['auth']], function() {
            Route::get('/my_books', [MyBooksController::class, 'index'])->name('myBooks');
            Route::delete('/delete-book/{book}', [MyBooksController::class, 'delete'])->name('books.deleteBook');
            Route::get('/user/lists', [ListController::class, 'getLists'])->name('user.lists');
            Route::post('/add-to-list/{book}', [BookController::class, 'addToUserList'])->name('books.addToList');
            Route::get('/lists/{list}/books', [ListController::class, 'getBooksByList'])->name('lists.showBooks');
            Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});