<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();


        if ($user && Auth::attempt($credentials)) {
            $request->session()->regenerate(); //ltr i will store the roles in sessions //zq
            return redirect()->intended('userhomepage');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->onlyInput('email');    }
}
