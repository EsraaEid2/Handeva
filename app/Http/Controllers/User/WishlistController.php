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
    public function showWishlist()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            // Fetch wishlist items for logged-in users
            $wishlistItems = \DB::table('wishlists')
                ->join('products', 'wishlists.product_id', '=', 'products.id')
                ->leftJoin('product_images', function ($join) {
                    $join->on('product_images.product_id', '=', 'products.id')
                         ->where('product_images.is_primary', '=', 1);
                })
                ->where('wishlists.user_id', Auth::id())
                ->where('wishlists.is_deleted', 0)
                ->select(
                    'products.id',
                    'products.title',
                    'products.price',
                    'products.stock_quantity',
                    'product_images.image_url'
                )
                ->get();
        } else {
            // Fetch wishlist items for guest users
            $wishlistProductIds = session()->get('wishlist', []);
            $wishlistItems = \DB::table('products')
                ->leftJoin('product_images', function ($join) {
                    $join->on('product_images.product_id', '=', 'products.id')
                         ->where('product_images.is_primary', '=', 1);
                })
                ->whereIn('products.id', $wishlistProductIds)
                ->select(
                    'products.id',
                    'products.title',
                    'products.price',
                    'products.stock_quantity',
                    'product_images.image_url'
                )
                ->get();
        }
    
        return view('theme.wishlist', ['wishlistItems' => $wishlistItems]);
    }
    
    
    /**
     * Remove a product from the wishlist.
     */
    public function removeProduct($product_id)
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            // If the user is logged in, remove from the database
            $wishlist = \DB::table('wishlists')
                ->where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->where('is_deleted', 0)
                ->first();
    
            if ($wishlist) {
                \DB::table('wishlists')
                    ->where('id', $wishlist->id)
                    ->update(['is_deleted' => 1]); // Soft delete by marking as deleted
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found in wishlist']);
            }
        } else {
            // Handle guest user (if applicable)
            $wishlist = session()->get('wishlist', []);
            if (($key = array_search($product_id, $wishlist)) !== false) {
                unset($wishlist[$key]);
                session()->put('wishlist', $wishlist); // Update the session after removing the product
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found in wishlist']);
            }
        }
    }
    
    
}