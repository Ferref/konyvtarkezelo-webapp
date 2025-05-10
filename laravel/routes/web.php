<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Home page (show available books)
Route::get('/', [BookController::class, 'getBooks']);

// Books
Route::post('/create-book', [BookController::class, 'create']);
Route::get('/get-books', [BookController::class, 'getBooks']);
Route::delete('/delete-book/{book}', [BookController::class, 'deleteBook']);
Route::get('/edit-book/{book}', [BookController::class, 'showEditBookForm']);
Route::put('/edit-book/{book}', [BookController::class, 'editBook']);
