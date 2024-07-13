<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});

require __DIR__.'/product.php';
require __DIR__.'/category.php';
