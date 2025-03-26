<?php

use Illuminate\Support\Facades\Route;

// Route::get('/login', function () {
//     return view('login');
// })->name('login');

Route::get('/', function () {
    return view('login');
});


Route::get('/userhomepage', function () {
        return view('userhomepage');
    })->name('userhomepage');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/vendorhomepage', function () {
    return view('vendorhomepage');
})->name('vendorhomepage');

Route::get('/riderhomepage', function () {
    return view('riderhomepage');
})->name('riderhomepage');