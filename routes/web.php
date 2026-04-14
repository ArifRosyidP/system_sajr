<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tampilan', function () {
    return view('tampilan');
});
Route::get('products/dataTable', [ProductController::class, 'serversideTable']);
Route::resource('products', ProductController::class)->except(['create', 'edit']);
// Route::get('products/dataTable', [ProductController::class, 'serversideTable']);
Route::resource('setup/klien', ClientController::class)->except(['create', 'edit']);
Route::resource('/login', LoginController::class)->except(['create', 'edit']);