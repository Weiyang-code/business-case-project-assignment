<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function showMenuPage(Request $request)
{
    $query = \App\Models\Menu::where('active', 1);

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('vegetarian')) {
        $query->where('vegetarian', $request->vegetarian);
    }

    $menuItems = $query->get();

    return view('customer.menupage', compact('menuItems'));
}


}