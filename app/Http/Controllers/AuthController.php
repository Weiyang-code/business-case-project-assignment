<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request for email and password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $selectedRole = $request->session()->get('selected_role');

        $user = User::where('email', $credentials['email'])
            ->where('role', $selectedRole)
            ->first();

        if ($user) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                switch ($selectedRole) {
                    case 'Vendor':
                        return redirect()->intended('vendorhomepage');
                    case 'Rider':
                        return redirect()->intended('riderhomepage');
                    default: // Default to User
                        return redirect()->intended('userhomepage');
                }
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->onlyInput('email');
            }
        } else {
            return back()->withErrors([
                'role' => 'No account found with the selected role. Try again or register',
            ])->onlyInput('email');
        }
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Get role from session
        $role = session('role', 'User'); // Default to 'User' if session is empty

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role,
        ]);

        Auth::login($user);
        session()->forget('role');


        return redirect()->route('register')->with('success', 'Registration successful! You can now log in.');
    }
}
