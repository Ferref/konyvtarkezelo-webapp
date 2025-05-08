<?php

use App\Http\Controllers\BookController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

// Home page (show available books)
Route::get('/', [BookController::class, 'getAllBooks']);

// Books
Route::post('/create-book', [BookController::class, 'create']);
Route::get('/get-books', [BookController::class, 'getAllBooks']);
Route::delete('/delete-book/{book}', [BookController::class, 'deleteBook']);
Route::get('/edit-book/{book}', [BookController::class, 'showEditBookForm'])
    ->name('books.edit');
Route::put('/edit-book/{book}', [BookController::class, 'editBook'])
    ->name('books.update');
