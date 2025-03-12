<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [BookController::class, 'showLogin'])->name('login');
Route::post('/login', [BookController::class, 'login']);
Route::get('/register', [BookController::class, 'showRegister'])->name('register');
Route::post('/register', [BookController::class, 'register']);
Route::post('/logout', [BookController::class, 'logout'])->name('logout');

// Dashboard Route
Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');

// Book Routes
Route::resource('books', BookController::class);
Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');    

