<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data['users'] = User::where('id', '!=', Auth::id())->limit(6)->get();
        return view('welcome', $data);
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function login_store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        // Attempt to authenticate
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Welcome back! You are now logged in.');
        }

        // Authentication failed
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('register');
    }

    public function register_store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'terms' => 'required|accepted',
        ], [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
            'terms.required' => 'You must accept the terms and conditions',
        ]);

        // Create new user
        try {
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Auto login after registration
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Account created successfully! Welcome to Reverb Messenger.');
        } catch (\Exception $e) {
            return back()
                ->withInput($request->only('first_name', 'last_name', 'email'))
                ->with('error', 'An error occurred while creating your account. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
