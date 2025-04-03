<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\VendorController;


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

Route::match(['get', 'post'], '/userhomepage', function () {
    return view('customer.userhomepage');
})->name('userhomepage');

Route::get('/menupage', [MenuController::class, 'showMenuPage'])->name('menupage');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/orders/{id}', [OrderController::class, 'view'])->name('orders.view');
Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders.user');
Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');



// Route::get('/menupage', function () {
//     return view('customer.menupage');
// })->name('menupage');

// Route::match(['get', 'post'],'/restaurantpage', function () {
//         return view('customer.restaurantpage');
//     })->name('restaurantpage');    

// Route::match(['get', 'post'],'/cartpage', function () {
//         return view('customer.cartpage');
//     })->name('cartpage'); 

// Route::match(['get', 'post'],'/paymentpage', function () {
//         return view('customer.paymentpage');
//     })->name('paymentpage'); 

// Route::match(['get', 'post'],'/orderstatuspage', function () {
//         return view('customer.orderstatuspage');
//     })->name('orderstatuspage'); 


//---------------------------------VENDOR------------------------------------//

Route::get('/vendorhomepage', function () {
    return view('vendor.vendorhomepage');
})->name('vendorhomepage');

Route::get('/vendorhomepage', [OrderController::class, 'showOrders'])->name('vendor.vendorhomepage');

Route::get('/orderacceptpage/{id}', [OrderController::class, 'orderDetails'])->name('vendor.orderacceptpage');

Route::get('/vendorstatuspage/{id}', [OrderController::class, 'orderStatus'])->name('vendorstatuspage');

Route::get('/vendorhistorypage', [OrderController::class, 'vendorOrders'])->name('vendorhistorypage');

Route::match(['get', 'post'], '/addfooditempage/{id}', [VendorController::class, 'addFoodItem'])->name('addfooditempage');


//---------------------------------RIDER-------------------------------------//

Route::get('/riderhomepage', function () {
    return view('rider.riderhomepage');
})->name('riderhomepage');

Route::get('/riderhomepage', [OrderController::class, 'showOrders'])->name('rider.riderhomepage');

Route::get('/orderdetailpage/{id}', [OrderController::class, 'orderDetails'])->name('rider.orderdetailpage');

Route::get('/riderstatuspage/{id}', [OrderController::class, 'orderStatus'])->name('riderstatuspage');

Route::get('/commissionpage/{id}', [OrderController::class, 'commissionDetails'])->name('commissionpage');

Route::get('/riderhistorypage', [OrderController::class, 'riderOrders'])->name('riderhistorypage');


