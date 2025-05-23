<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(AdminMiddleware::class)
    ->name('dashboard');

// Book Routes
Route::get('/books', [BookController::class, 'index'])
    ->middleware(MemberMiddleware::class)
    ->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])
    ->middleware(AdminMiddleware::class)
    ->name('books.create');
Route::post('/books', [BookController::class, 'store'])
    ->middleware(AdminMiddleware::class)
    ->name('books.store');
Route::get('/books/{book}', [BookController::class, 'show'])
    ->middleware(MemberMiddleware::class)
    ->name('books.show');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])
    ->middleware(AdminMiddleware::class)
    ->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])
    ->middleware(AdminMiddleware::class)
    ->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])
    ->middleware(AdminMiddleware::class)
    ->name('books.destroy');

// Borrowing Routes
Route::get('/borrowings', [BorrowingController::class, 'index'])
    ->middleware(MemberMiddleware::class)
    ->name('borrowings.index');
Route::get('/borrowings/create', [BorrowingController::class, 'create'])
    ->middleware(AdminMiddleware::class)
    ->name('borrowings.create');
Route::post('/borrowings', [BorrowingController::class, 'store'])
    ->middleware(AdminMiddleware::class)
    ->name('borrowings.store');
Route::post('/borrowings/{borrowings}/return', [BorrowingController::class, 'returnBook'])
    ->middleware(AdminMiddleware::class)
    ->name('borrowings.return');

// Users management
    Route::resource('users', UserController::class);