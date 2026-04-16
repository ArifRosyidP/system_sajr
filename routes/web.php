<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('products.index', ['title' => 'Produk']);
// });

Route::group(['middleware' => ['auth','cekrole:admin']], function(){
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/dataTable', [ProductController::class, 'serversideTable']);
    Route::resource('products', ProductController::class)->except(['create', 'edit']);
});

Route::group(['middleware' => 'auth'], function(){
    
    Route::get('setup/klien', [ClientController::class, 'index'])->name('setup.klien');
    Route::get('setup/klien/dataTable', [ClientController::class, 'serversideTable']);
    Route::resource('klien', ClientController::class)->except(['create', 'edit']);
});
    
Route::group(['middleware' => 'guest'], function(){
    // LOGIN
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');

    // REGISTER
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});
// Route::get('products/dataTable', [ProductController::class, 'serversideTable']);
// Route::resource('/login', LoginController::class)->except(['create', 'edit']);
// Route::resource('/register', RegisterController::class)->except(['create', 'edit']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
