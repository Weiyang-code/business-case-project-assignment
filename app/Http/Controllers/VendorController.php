<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function addFoodItem($id)
    {
        return view('vendor.addfooditempage', compact('id'));
    }
}
