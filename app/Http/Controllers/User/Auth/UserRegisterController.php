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
        // Validate incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'age' => 'nullable|integer',  
        ]);
      
        // $isPendingVendor = $request->role_id == 2 ? 1 : 0;
  
        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1, // Default role is customer
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'is_pending_vendor' =>$request->role_id == 2 ? 1 : 0,
        ]);

        // Log the user in
        Auth::guard('web')->login($user);
        
    // Redirect based on role
    if ($user->role_id == 1) { // Customer
        return redirect()->route('collections');
    } elseif ($user->role_id == 2) { // Vendor
        return redirect()->route('vendor.dashboard');
    }
    }
    
    
}