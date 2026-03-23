<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // validate the req data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8',
            'phone_no'   => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:500',
        ]);

        // reate user
        /* $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'name'       => $validated['first_name'] . ' ' . $validated['last_name'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'phone_no'   => $request->phone_no,
            'address'    => $request->address,
        ]); */

        $user = $this->userService->registerUser($validated);

        // return response()->json(['message' => 'User created successfully!', 'user' => $user]);

        return redirect('/')->with('success', 'Registration successful!');
    }

    // login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($this->userService->authenticateUser($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = $this->userService->getAuthenticatedUser();
            if ($user->isAdmin()) return redirect()->route('admin.dashboard');
            if ($user->isManager()) return redirect()->route('manager.dashboard');
            
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    // logout
    public function logout(Request $request) {
        $this->userService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    }

    // Profile methods
    public function profile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Check current password if user wants to change password
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $validated['password'] = Hash::make($request->new_password);
        }

        // Update user name
        $validated['name'] = $validated['first_name'] . ' ' . $validated['last_name'];

        // Remove password fields from validated data if not changing password
        if (!$request->filled('new_password')) {
            unset($validated['current_password'], $validated['new_password'], $validated['new_password_confirmation']);
        } else {
            unset($validated['current_password'], $validated['new_password_confirmation']);
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
