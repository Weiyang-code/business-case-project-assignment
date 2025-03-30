<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $menuItem = Menu::findOrFail($id);

        // Get cart from session or create an empty array
        $cart = session()->get('cart', []);

        // If item exists in cart, increase quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Otherwise, add new item
            $cart[$id] = [
                "name" => $menuItem->name,
                "quantity" => 1,
                "price" => $menuItem->price,
                "image" => $menuItem->image
            ];
        }

        // Store cart in session
        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart!');
    }
}
