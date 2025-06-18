<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserInvoiceController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;

//Guest
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/book/{book}', [HomeController::class, 'show'])->name('book.detail');

//Authenticator
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

//user login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cart}', [CartController::class, 'update'])->name('cart.update'); // MODIFIKASI: Rute untuk update kuantitas
    Route::delete('/cart/remove/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // checkout, invoice
    Route::post('/checkout', [InvoiceController::class, 'checkout'])->name('checkout');
    Route::post('/buy-now/{book}', [InvoiceController::class, 'buyNow'])->name('buy.now');
    Route::get('/my-invoices', [UserInvoiceController::class, 'index'])->name('user.invoices.index'); // PENAMBAHAN: Halaman riwayat transaksi user
    Route::get('/my-invoices/{invoice}', [UserInvoiceController::class, 'show'])->name('user.invoices.show');
});

//admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // main admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD
    Route::resource('books', BookController::class);

    // Category management
    Route::resource('categories', CategoryController::class)->except(['show']);

    // User management
    Route::resource('users', AdminUserController::class);
    // management invoice
    Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [AdminInvoiceController::class, 'show'])->name('invoices.show');
});
