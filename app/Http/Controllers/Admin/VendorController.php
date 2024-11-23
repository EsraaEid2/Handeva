<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Role;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    // Display list of vendors

    public function index(Request $request)
    {
        $search = $request->get('search');
    
        // Using withCount to fetch the count of non-deleted products for each vendor
        $vendors = Vendor::withCount(['products' => function ($query) {
            $query->whereNull('deleted_at');  // Filtering products that are not soft-deleted
        }])
        ->when($search, function ($query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->paginate(10);
        $roles = Role::all();
        return view('admin.vendors.index', compact('vendors','roles'));
    }
    


    // Show form to create a new vendor
    public function create()
    {
        return view('admin.vendors.create');
    }

    // Store a new vendor
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $vendor = new Vendor();
        $vendor->role_id = $request->role_id;
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;
        $vendor->password = bcrypt($request->password);
        $vendor->save();

        return redirect()->route('admin.vendors.index')->with('successAdd', 'Vendor created successfully!');
    }

    // Show form to edit a vendor
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    // Update an existing vendor
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $vendor->role_id = $request->role_id;
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;

        if ($request->filled('password')) {
            $vendor->password = bcrypt($request->password);
        }

        $vendor->save();

        return redirect()->route('admin.vendors.index')->with('successUpdate', 'Vendor updated successfully!');
    }


    // Soft delete a vendor
    public function destroy(Vendor $vendor)
    {
        // Soft delete the vendor
        $vendor->delete();
    
        // Return a JSON response indicating success
        return response()->json(['success' => true, 'message' => 'Vendor deleted successfully!']);
    }
    

}