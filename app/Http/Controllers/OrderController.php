<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function showOrders()
    {
        $orders = Order::all(); // Fetch all menu items from the database (for each in blade must use this)
        return view('rider.riderhomepage', compact('orders'));
    }
}
