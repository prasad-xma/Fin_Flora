<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UserService;

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
}
