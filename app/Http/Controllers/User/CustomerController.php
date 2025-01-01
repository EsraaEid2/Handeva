<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function showAccount()
    {
        $user = Auth::guard('web')->user();
        
        if ($user && $user->role_id == 1) {
            $query = Order::where('user_id', $user->id)
                ->with(['orderItems.product']);
    
            // Apply filters
            if (request('status')) {
                $query->where('status', request('status'));
            }
            
            // Get paginated results
            $orders = $query->latest()->paginate(10);
    
            return view('theme.my-account', compact('user', 'orders'));
        }
        
        return redirect()->route('user.home')->with('error', 'Unauthorized access.');
    }

    public function updateProfile(Request $request)
{
    $user = Auth::guard('web')->user();
    
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'phone_number' => 'nullable|string|max:20',
        'age' => 'required|numeric|min:1|max:150',
        'address' => 'required|string|max:255',
    ]);

    try {
        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone_number',
            'age',
            'address'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating your profile'
        ], 500);
    }
}

public function updatePassword(Request $request)
{
    $user = Auth::guard('web')->user();
    
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|string|min:8|confirmed',
    ]);

    try {
        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while updating your password'
        ], 500);
    }
}
}