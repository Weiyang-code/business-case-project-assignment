<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function showMenuPage()
    {
        $menuItems = \App\Models\Menu::where('active', 1)->get();
        return view('customer.menupage', compact('menuItems'));
    }
}