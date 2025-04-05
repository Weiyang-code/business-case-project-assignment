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
        if (Auth::user()->role === 'Rider') {
            return view('runner.runnerhomepage', compact('orders'));
        } elseif (Auth::user()->role === 'Vendor') {
            return view('restaurant.restauranthomepage', compact('orders'));
        }
        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    public function orderDetails($id)
    {
        $order = Order::with(['user', 'items.menu'])->findOrFail($id);
        
        if (Auth::user()->role === 'Rider') {
            return view('runner.orderdetailpage', compact('order'));
        } elseif (Auth::user()->role === 'Vendor') {
            return view('restaurant.orderacceptpage', compact('order'));
        }
        return redirect()->back()->with('error', 'Unauthorized access.');// Pass order to view
    }

    public function orderStatus($id)
    {
        $order = Order::with(['user', 'items.menu'])->findOrFail($id);
        
        if (Auth::user()->role === 'Rider') {
            return view('runner.runnerstatuspage', compact('order'));
        } elseif (Auth::user()->role === 'Vendor') {
            return view('restaurant.restaurantstatuspage', compact('order'));
        }
        return redirect()->back()->with('error', 'Unauthorized access.');// Pass order to view
    }

    public function commissionDetails($id)
    {
        $order = Order::with(['user', 'items.menu'])->findOrFail($id);
        return view('runner.commissionpage', compact('order'));
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

    public function runnerOrders()
    {
        $userId = Auth::id(); // Get the authenticated user ID
        $orders = Order::where('rider_id', $userId)->orderBy('placed_at', 'desc')->get(); // Fetch user's orders

        return view('runner.runnerhistorypage', compact('orders'));
    }

    public function restaurantOrders()
    {
        $userId = Auth::id(); // Get the authenticated user ID
        $orders = Order::where('vendor_id', $userId)->orderBy('placed_at', 'desc')->get(); // Fetch user's orders

        return view('restaurant.restauranthistorypage', compact('orders'));
    }

    public function updateStatus(Request $request)
{
    $userId = Auth::id();
    $request->validate([
        'order_id' => 'required|integer|exists:orders,id',
        'status' => 'required|string',
    ]);

    $order = Order::where('id', $request->order_id)
                 ->whereNotIn('status', ['completed', 'cancelled'])
                 ->first();

    if (!$order) {
        return redirect()->back()->with('error', 'Order cannot be updated.');
    }

    $order->update(['status' => $request->status]);

    if ($request->status === 'preparing') {
        $order->update(['vendor_id' => $userId]);
    }

    if ($request->status === 'assigned') {
        $order->update(['rider_id' => $userId]);
    }   

    // Redirect to the provided URL, or fallback to a default page
    return redirect($request->input('redirect_url', url()->previous()))
        ->with('success', 'Order status updated successfully!');
}

}
