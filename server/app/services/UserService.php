<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function registerUser(array $data): User
    {
        // creating the user
        return User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'name'       => $data['first_name'] . ' ' . $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'phone_no'   => $data['phone_no'] ?? null,
            'address'    => $data['address'] ?? null,
        ]);
    }
}