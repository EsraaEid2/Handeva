<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // If there's a search term, filter users
        $users = User::with('role') // Ensure to load the role relationship
            ->where('is_deleted', 0)
            ->where(function($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('role', function ($roleQuery) use ($search) {
                        $roleQuery->where('role_type', 'like', "%{$search}%");
                    });
            })
            ->get();  // Use get() instead of paginate to fetch all users
    
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
            'is_deleted' => 'nullable|boolean',  // Handling soft delete status
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
            'is_deleted' => 'nullable|boolean', // Allow admin to update the soft delete status
        ]);
    
        // Check if the password is being updated
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Keep the current password
        }
    
        // Check if the role_id has changed
        $originalRole = $user->role_id;
        if ($originalRole != $validated['role_id']) {
            // Role is being updated
            if ($validated['role_id'] == 2) { // Role 2 is vendor
                // Check if the user is already a vendor
                $vendorExists = Vendor::where('role_id', $user->id)->exists();
    
                if (!$vendorExists) {
                    // Create a new vendor record
                    Vendor::create([
                        'user_id' => $user->id,
                        'role_id' => 2, // Ensure role_id is set to 2 for vendors
                        'first_name' => $validated['first_name'],
                        'last_name' => $validated['last_name'],
                        'email' => $validated['email'],
                        'password' => $user->password, // Pass the password as it is from the User table
                    ]);
                }
            } elseif ($originalRole == 2 && $validated['role_id'] != 2) {
                // Role changed from vendor to another role
                // Optionally handle vendor removal (e.g., soft delete the vendor record)
                Vendor::where('user_id', $user->id)->delete();
            }
        }
    
        // Update the user with the validated data
        $user->update($validated);
    
        return redirect()->route('admin.users.index')->with('successUpdate', 'User updated successfully!');
    }
    

//     public function updateUserRole(Request $request, $id)
// {
//     $user = User::findOrFail($id);
//     $newRole = $request->input('role_id'); 

  
//     if ($newRole == 2 && $user->role_id != 2) {
        
//         Vendor::updateOrCreate(
//             ['user_id' => $user->id],
//             ['business_name' => $request->input('business_name', 'Default Vendor Name')]
//         );
//     }

//     $user->role_id = $newRole;
//     $user->save();

//     return redirect()->back()->with('status', 'Role updated successfully.');
// }

    public function destroy(User $user)
    {
        // Soft delete: Update the user's 'is_deleted' status to 1
        $user->update(['is_deleted' => 1]);
    
        return response()->json(['success' => true]);
    }
    
}