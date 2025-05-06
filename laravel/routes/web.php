<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Books
Route::post('/create-book', [BookController::class, 'create']);
