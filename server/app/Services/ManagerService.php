<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerService
{
    public function createManager(array $data): User
    {
        $data['role'] = 'manager';
        $data['password'] = Hash::make($data['password']);
        
        // Generate full name from first and last name
        $data['name'] = trim($data['first_name'] . ' ' . $data['last_name']);
        
        return User::create($data);
    }

    public function updateManager(User $manager, array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Update name if first_name or last_name is provided
        if (isset($data['first_name']) || isset($data['last_name'])) {
            $firstName = $data['first_name'] ?? $manager->first_name;
            $lastName = $data['last_name'] ?? $manager->last_name;
            $data['name'] = trim($firstName . ' ' . $lastName);
        }

        $manager->update($data);
        return $manager;
    }

    public function deleteManager(User $manager): bool
    {
        return $manager->delete();
    }

    public function getAllManagers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::where('role', 'manager')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getManagerById(int $id): ?User
    {
        return User::where('role', 'manager')->find($id);
    }

    public function toggleManagerStatus(User $manager): User
    {
        $manager->is_active = !$manager->is_active;
        $manager->save();
        
        return $manager;
    }
}
