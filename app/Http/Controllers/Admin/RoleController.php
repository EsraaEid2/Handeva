<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Show all roles.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->input('search');
        
        // Query the roles with optional search filtering
        $roles = Role::query()
            ->when($search, function ($query) use ($search) {
                $query->where('role_type', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc') // Default sorting by newest roles
            ->get(); 
    
        // Pass the roles and search term to the view
        return view('admin.roles.index', [
            'roles' => $roles,
            'search' => $search, // Include the search term for reuse in the view
        ]);
    }
    
    
    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_type' => 'required|string|max:255|unique:roles',
        ]);
    
        Role::create([
            'role_type' => $request->input('role_type'),
        ]);
    
        return redirect()->route('roles.index')->with('successAdd', 'Role added successfully.');
    }
    

    /**
     * Show the form for editing the specified role.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        // Validate the data
        $request->validate([
            'role_type' => ['required', 'string', 'in:customer,vendor,admin'],
        ]);

        // Update the role
        $role->update([
            'role_type' => $request->role_type,
        ]);

        return redirect()->route('roles.index')->with('successUpdate', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from the database.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return response()->json(['success' => true, 'successDelete' => 'Role deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'successDelete' => 'Failed to delete the role.']);
        }
    }
    
    
}