<?php

use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
//     return view('login');
// })->name('login');

Route::get('/', function () {
    return view('login');
});

Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');
