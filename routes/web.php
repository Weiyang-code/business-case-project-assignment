<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::match(['get', 'post'],'/userhomepage', function () {
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