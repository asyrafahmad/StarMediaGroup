<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Handle registration
    public function register(Request $request)
    {
        $messages = [
            'password.regex' => 'Password must be at least 8 characters long, contain at least one uppercase, one lowercase, one number, and one special character.',
        ];

        // Validate input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
],
        ], $messages);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('login')->with('success', 'Registration successful! Welcome, ' . $user->name);
    }

    // Handle login
    public function login(Request $request)
    {
        try {
            // Validate input
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // Attempt login
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('admin')
                    ->with('success', 'Login successful!');
            }

            // Failed login
            return back()->withErrors([
                'login_error' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            // Handle unexpected errors
            \Log::error('Login error: ' . $e->getMessage());

            return back()->withErrors([
                'login_error' => 'An unexpected error occurred. Please try again later.',
            ])->withInput();
        }
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
