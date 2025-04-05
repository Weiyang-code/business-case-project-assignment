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

        $selectedRole = $request->session()->get('selected_role', 'User');

        $user = User::where('email', $credentials['email'])
            ->where('role', $selectedRole)
            ->first();

        if ($user) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                switch ($selectedRole) {
                    case 'Vendor':
                        return redirect()->intended('restauranthomepage');
                    case 'Rider':
                        return redirect()->intended('runnerhomepage');
                    default: // Default to User
                        return redirect()->intended('customerhomepage');
                }
            } else {
                return back()->withErrors([
                    'password' => 'The provided password is incorrect.',
                ])->onlyInput('email');
            }
        } else {
            $request->session()->flush();
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
            'phone' => 'nullable|string|max:15',
        ]);

        $role = session('role', 'User'); // Default to 'User' if session is empty

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone, // Save phone number
            'password' => bcrypt($request->password),
            'role' => $role,
        ]);

        Auth::login($user);
        session()->forget('role');

        return redirect()->route('register')->with('success', 'Registration successful! You can now log in.');
    }
}
