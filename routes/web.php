<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', function () {
    return view('register');
})->name('register');

//-------------------------------------------------------------------//

Route::match(['get', 'post'],'/userhomepage', function () {
        return view('customer.userhomepage');
    })->name('userhomepage');

Route::match(['get', 'post'],'/restaurantpage', function () {
        return view('customer.restaurantpage');
    })->name('restaurantpage');    

Route::match(['get', 'post'],'/cartpage', function () {
        return view('customer.cartpage');
    })->name('cartpage'); 

Route::match(['get', 'post'],'/paymentpage', function () {
        return view('customer.paymentpage');
    })->name('paymentpage'); 

Route::match(['get', 'post'],'/orderstatuspage', function () {
        return view('customer.orderstatuspage');
    })->name('orderstatuspage'); 


//-------------------------------------------------------------------//

Route::get('/vendorhomepage', function () {
    return view('vendor.vendorhomepage');
})->name('vendorhomepage');

Route::match(['get', 'post'],'/orderacceptpage', function () {
    return view('vendor.orderacceptpage');
})->name('orderacceptpage');    

Route::match(['get', 'post'],'/vendorstatuspage', function () {
    return view('vendor.vendorstatuspage');
})->name('vendorstatuspage'); 

Route::match(['get', 'post'],'/addfooditempage', function () {
    return view('vendor.addfooditempage');
})->name('addfooditempage'); 


//-------------------------------------------------------------------//

Route::get('/riderhomepage', function () {
    return view('rider.riderhomepage');
})->name('riderhomepage');

Route::get('/orderdetailpage', function () {
    return view('rider.orderdetailpage');
})->name('orderdetailpage');

Route::get('/riderstatuspage', function () {
    return view('rider.riderstatuspage');
})->name('riderstatuspage');

Route::get('/commissionpage', function () {
    return view('rider.commissionpage');
})->name('commissionpage');

