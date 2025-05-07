<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/get-books', [BookController::class, 'getAllBooks']);

// Books
Route::post('/create-book', [BookController::class, 'create']);
Route::get('/get-books', [BookController::class, 'getAllBooks']);
