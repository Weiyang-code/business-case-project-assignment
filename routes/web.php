<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;



//checking session route
Route::get('/session', function (Request $request) {
    return $request->session()->all();
});

//setting login role in session
Route::post('/set-role', function (Request $request) {
    $request->session()->put('selected_role', $request->input('role'));
    return response()->json(['message' => 'Role set successfully']);
})->name('set-role');

// get login role of the session
Route::get('/get-role', function (Request $request) {
    return response()->json(['role' => $request->session()->get('selected_role', 'User')]);
})->name('get-role');

//for register role
Route::post('/set-session-role', function (Request $request) {
    session(['role' => $request->role]);
    return response()->json(['success' => true]);
})->name('set.session.role');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


Route::get('/', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


//----------------------------------USER--------------------------------------//

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


//---------------------------------VENDOR------------------------------------//

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


//---------------------------------RIDER-------------------------------------//

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

