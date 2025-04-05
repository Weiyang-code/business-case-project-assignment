<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    // Show the add food item form
    public function addFoodItem($id)
    {
        return view('restaurant.addfooditempage', compact('id'));
    }

    public function viewMenu()
{
    // Get the restaurant of the logged-in vendor
    $restaurant = \App\Models\Restaurant::where('user_id', auth()->user()->id)->first();

    if (!$restaurant) {
        return redirect()->back()->withErrors(['restaurant' => 'Restaurant not found.']);
    }

    // Get all food items for the specific restaurant
    $menus = \App\Models\Menu::where('restaurant_id', $restaurant->id)->get();

    // Pass menus to the view
    return view('restaurant.viewmenu', compact('menus'));
}



    // Store the food item
    public function storeFoodItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $restaurant = \App\Models\Restaurant::where('user_id', auth()->id())->first();
        if (!$restaurant) {
            return redirect()->back()->withErrors(['restaurant' => 'Restaurant not found or you do not own any restaurant.']);
        }

        if ($request->hasFile('image')) {
            // Store the image in public storage
            $imagePath = $request->file('image')->storeAs('images', $request->file('image')->getClientOriginalName(), 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }
        $validated['restaurant_id'] = $restaurant->id;

        \App\Models\Menu::create($validated);

        return redirect()->back()->with('success', 'Food item added successfully!');
    }

    public function editFoodItem($id)
    {
        // Fetch the food item by its ID
        $menu = \App\Models\Menu::find($id);
    
        // If the menu item is not found, redirect back with an error
        if (!$menu) {
            return redirect()->route('restaurant.viewmenu')->withErrors(['menu' => 'Food item not found.']);
        }
    
        // Pass the 'menu' variable to the view
        return view('restaurant.editfooditem', compact('menu'));
    }

    public function updateFoodItem(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the food item
        $menu = \App\Models\Menu::find($id);

        if (!$menu) {
            return redirect()->route('restaurant.viewmenu')->withErrors(['menu' => 'Food item not found.']);
        }

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('images', $request->file('image')->getClientOriginalName(), 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        // Update the food item
        $menu->update($validated);

        return redirect()->route('restaurant.viewmenu')->with('success', 'Food item updated successfully!');
    }
}
