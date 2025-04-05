<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function addFoodItem($id)
    {
        return view('restaurant.addfooditempage', compact('id'));
    }
}
