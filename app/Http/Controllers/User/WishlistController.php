<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Add a product to the wishlist.
     */
    public function addToWishlist(Request $request)
    {
        $productId = $request->product_id;

        // if the user logged in
        if (Auth::check() && Auth::user()->role_id == 1) {
            $userId = Auth::id();

          // check if product already exist in table
            $existingWishlist = \DB::table('wishlists')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('is_deleted', 0)
                ->first();

            if ($existingWishlist) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in the wishlist.',
                ]);
            }

            // add product to wislist table
            \DB::table('wishlists')->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'is_deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Product successfully added to the wishlist.',
            ]);
        }

        // if user is guest
        $wishlist = session()->get('wishlist', []);

        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'message' => 'Product successfully added to the wishlist.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product is already in the wishlist.',
        ]);
    }
    /**
     * View the wishlist.
     */
    public function viewWishlist()
    {
        // Fetch wishlist from session
        $wishlist = session()->get('wishlist', []);

        return view('theme.wishlist', compact('wishlist'));
    }

    /**
     * Remove a product from the wishlist.
     */
    public function removeFromWishlist(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

        // Remove the product from session
        if (($key = array_search($request->product_id, $wishlist)) !== false) {
            unset($wishlist[$key]);
            session()->put('wishlist', $wishlist); // Update the session

            return response()->json([
                'success' => true,
                'message' => 'Product successfully removed from the wishlist.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in the wishlist.'
        ]);
    }
}