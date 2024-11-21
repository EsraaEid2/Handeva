<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Add product to the wishlist
    public function addToWishlist(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Check if the product is already in the user's wishlist
        if (Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->where('is_deleted', false)
            ->exists()) {
            return response()->json(['message' => 'Product already in wishlist!'], 400);
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'is_deleted' => false,
        ]);

        return response()->json(['message' => 'Product added to wishlist!'], 200);
    }

    // Remove product from the wishlist (soft delete)
    public function removeFromWishlist($productId)
    {
        $wishlistItem = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->where('is_deleted', false)
            ->firstOrFail();

        $wishlistItem->softDelete();

        return response()->json(['message' => 'Product removed from wishlist!'], 200);
    }

    // Display the user's wishlist
    public function showWishlist()
    {
        $wishlistItems = Wishlist::where('user_id', auth()->id())
            ->where('is_deleted', false)
            ->with('product')
            ->get();

        return view('user.wishlist', compact('wishlistItems'));
    }
}