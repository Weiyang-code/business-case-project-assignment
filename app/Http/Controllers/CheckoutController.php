<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderPlacedMail;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('menu')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        return view('customer.checkoutpage', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('menu')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Validate input
        $request->validate([
            'payment_method' => 'required|string',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $subtotal = $cartItems->sum(fn($item) => $item->menu->price * $item->quantity);
        $deliveryFee = 3.00;
        $totalPrice = $subtotal + $deliveryFee;

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'delivery_address' => $request->delivery_address,
            'notes' => $request->notes,
            'restaurant' => $cartItems->first()->menu->restaurant ?? 'Unknown',
            'placed_at' => now(),
            'delivery_fee' => $deliveryFee,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item->food_id,
                'quantity' => $item->quantity,
                'price' => $item->menu->price,
                'total' => $item->menu->price * $item->quantity,
            ]);
        }

        Cart::where('user_id', $userId)->delete();

        // send email to user with order details (receipt)
        Mail::to(Auth::user()->email)->send(new OrderPlacedMail($order));

        return redirect()->route('orders.view', ['id' => $order->id])
            ->with('success', 'Order placed successfully! A confirmation email has been sent.');
    }
}
