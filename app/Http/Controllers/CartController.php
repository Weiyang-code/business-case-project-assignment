<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        // $menuItem = Menu::findOrFail($id);
        $userId = Auth::id();

        $quantity = max(1, (int) $request->input('quantity', 1));

        $cartItem = Cart::where('user_id', $userId)->where('food_id', $id)->first();

        if ($cartItem) {
            // If item exists, update the quantity
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            // else create a new cart item
            Cart::create([
                'user_id' => $userId,
                'food_id' => $id,
                'quantity' => $quantity
            ]);
        }

        return back()->with('success', 'Item added to cart!');
    }

    public function viewCart()
    {
        $userId = Auth::id();

        $cartItems = Cart::where('user_id', $userId)->with('menu')->get();

        return view('customer.cartpage', compact('cartItems'));
    }

    public function removeFromCart($id)
    {
        $userId = Auth::id();
        // dd($userId);

        Cart::where('user_id', $userId)->where('food_id', $id)->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    public function updateCart(Request $request, $id)
    {
        $userId = Auth::id();

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', $userId)->where('food_id', $id)->first();
        // dd($cartItem);

        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);
        }

        return back()->with('success', 'Cart updated successfully!');
    }
}
