<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showOrders()
    {
        $orders = Order::all(); // Fetch all menu items from the database (for each in blade must use this)
        return view('rider.riderhomepage', compact('orders'));
    }


    //user order view
    public function view($id)
    {
        $order = Order::with('items.menu')->findOrFail($id);
        return view('customer.orderdetails', compact('order'));
    }
    
    //user check order
    public function userOrders()
    {
        $userId = Auth::id(); // Get the authenticated user ID
        $orders = Order::where('user_id', $userId)->orderBy('placed_at', 'desc')->get(); // Fetch user's orders

        return view('customer.orderstatuspage', compact('orders'));
    }
}
