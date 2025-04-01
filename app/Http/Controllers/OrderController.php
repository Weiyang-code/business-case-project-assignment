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
            return view('rider.riderhomepage', compact('orders'));
        } elseif (Auth::user()->role === 'Vendor') {
            return view('vendor.vendorhomepage', compact('orders'));
        }
        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    public function riderOrderDetails($id)
    {
        $order = Order::with(['user', 'items.menu'])->findOrFail($id);
        return view('rider.orderdetailpage', compact('order')); // Pass order to view
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

    public function updateStatus(Request $request)
{
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

    // Redirect to the provided URL, or fallback to a default page
    return redirect($request->input('redirect_url', url()->previous()))
        ->with('success', 'Order status updated successfully!');
}

}
