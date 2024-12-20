<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{


    public function addToWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);
        
        $user = Auth::user();
    
        if ($user->wishlist()->where('product_id', $request->input('product_id'))->exists()) {
            Alert::info('Info', 'Product is already in your wishlist!');
            return redirect()->back();
        }
    
        $user->wishlist()->create([
            'product_id' => $request->input('product_id'),
        ]);
    
        Alert::success('Success', 'Product added to wishlist successfully!');
        return redirect()->back();
    }
}