<?php

namespace App\Http\Controllers;

use App\Services\ManagerService;
use App\Models\User;
use Illuminate\Http\Request;

class AdminManagerController extends Controller
{
    public function __construct(
        protected ManagerService $managerService
    ) {}

    public function index()
    {
        $managers = $this->managerService->getAllManagers();
        return view('admin.managers.index', compact('managers'));
    }

    public function create()
    {
        return view('admin.managers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone_no' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $this->managerService->createManager($validated);

        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager created successfully!');
    }

    public function show(User $manager)
    {
        if ($manager->role !== 'manager') {
            return redirect()->route('admin.managers.index')
                ->with('error', 'Manager not found.');
        }

        return view('admin.managers.show', compact('manager'));
    }

    public function edit(User $manager)
    {
        if ($manager->role !== 'manager') {
            return redirect()->route('admin.managers.index')
                ->with('error', 'Manager not found.');
        }

        return view('admin.managers.edit', compact('manager'));
    }

    public function update(Request $request, User $manager)
    {
        if ($manager->role !== 'manager') {
            return redirect()->route('admin.managers.index')
                ->with('error', 'Manager not found.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $manager->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone_no' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $this->managerService->updateManager($manager, $validated);

        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager updated successfully!');
    }

    public function destroy(User $manager)
    {
        if ($manager->role !== 'manager') {
            return redirect()->route('admin.managers.index')
                ->with('error', 'Manager not found.');
        }

        $this->managerService->deleteManager($manager);

        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager deleted successfully!');
    }

    public function toggleStatus(User $manager)
    {
        if ($manager->role !== 'manager') {
            return redirect()->route('admin.managers.index')
                ->with('error', 'Manager not found.');
        }

        $this->managerService->toggleManagerStatus($manager);

        return redirect()->route('admin.managers.index')
            ->with('success', 'Manager status updated successfully!');
    }
}
