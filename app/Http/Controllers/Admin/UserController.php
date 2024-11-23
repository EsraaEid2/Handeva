<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // If there's a search term, filter users
        $users = User::with('role') // Ensure to load the role relationship
            ->where('is_deleted', 0)  // Add condition to filter by 'is_deleted = 0'
            ->where(function($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('role', function ($roleQuery) use ($search) {
                        $roleQuery->where('role_type', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);  // Add pagination
        
        // Fetch all available roles for the add user modal
        $roles = Role::all();
    
        return view('admin.users.index', compact('users', 'roles'));
    }
    
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'age' => 'nullable|integer',
            'points' => 'nullable|integer',
            'is_deleted' => 'required|boolean',  // Handling soft delete status
        ]);
    
        // Hash the password before storing
        $validated['password'] = Hash::make($validated['password']);
    
        try {
            // Create the new user with the validated data
            User::create($validated);
    
            return redirect()->route('admin.users.index')->with('successAdd', 'User created successfully!');
        } catch (\Exception $e) {
            // Log the exception and return an error message
            \Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the user.');
        }
    }
    

    // public function edit(User $user)
    // {
    //     // Pass the user data to the edit view
    //     return view('admin.users.edit', compact('user'));
    // }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'age' => 'nullable|integer|min:1',
            'points' => 'nullable|integer',
            'is_deleted' => 'required|boolean',  // Allow admin to update the soft delete status
        ]);

        // If password is filled, hash it
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // If password is not updated, keep the existing password
            unset($validated['password']);
        }

        // Update the user with the validated data
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('successUpdate', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Soft delete: Update the user's 'is_deleted' status to 1
        $user->update(['is_deleted' => 1]);
    
        return response()->json(['success' => true]);
    }
    
}