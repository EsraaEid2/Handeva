<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());    
        // Validate incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone_number' => 'nullable|string|max:255|required_if:is_pending_vendor,1',
            'is_pending_vendor' => 'required|boolean', // Ensure the vendor flag is present
        ]);

        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Default role is customer
            'phone_number' => $request->is_pending_vendor ? $request->phone_number : null,
            'is_pending_vendor' => $request->is_pending_vendor,
        ]);

        // Log the user in
        Auth::guard('web')->login($user);

        // Set success message and redirect based on vendor status
        if ($user->is_pending_vendor) {
            session()->flash('vendorSuccessAdd', 'Your vendor account has been created and is pending approval.');
            return redirect()->to('/');
        } else {
            session()->flash('successAdd', 'Your account has been successfully created.');
            return redirect()->to('/collections');
        }
        
    }
}