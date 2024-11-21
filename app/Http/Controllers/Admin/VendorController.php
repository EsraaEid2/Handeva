<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    // Display list of vendors
    public function index()
    {
        $vendors = Vendor::all();
        return view('admin.vendors.index', compact('vendors'));
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

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor created successfully!');
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

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor updated successfully!');
    }

    // Delete a vendor
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('admin.vendors.index')->with('success', 'Vendor deleted successfully!');
    }
}