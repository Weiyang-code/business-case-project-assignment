<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function showMenuPage()
    {
        $menuItems = Menu::all(); // Fetch all menu items from the database (for each in blade must use this)
        return view('customer.menupage', compact('menuItems'));
    }
}