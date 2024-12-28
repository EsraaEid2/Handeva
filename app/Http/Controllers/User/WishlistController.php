<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    /**
     * Add a product to the wishlist.
     */
    public function addToWishlist(Request $request)
    {
        $productId = $request->product_id;
        // ensure if product id send within request
        if (!$productId) {
            return response()->json([
                'success' => false,
                'message' => 'Product ID is required.',
            ]);
        }
    
        if (Auth::guard('web')->check()) {
            $userId = Auth::id();
            
           // if the product already exists in database
            $product = Product::find($productId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ]);
            }
    
           // if the product already exists in wishlist
            $existingWishlistItem = Wishlist::where('user_id', $userId)
                                           ->where('product_id', $productId)
                                           ->first();
    
            if ($existingWishlistItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist.',
                ]);
            }
    
          // Store the product in user's wishlist
            $wishlist = Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist.',
            ]);
        } else {
          // if the user is GUEST
            $wishlist = Session::get('wishlist', []);
    
         // if product already exist in session
            if (in_array($productId, $wishlist)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist.',
                ]);
            }
    
        // store product in session
            $wishlist[] = $productId;
            Session::put('wishlist', $wishlist);
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist.',
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Product not found.',
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
    public function removeFromWishlist(Request $request)
    {
        $productId = $request->product_id;
    
        // إذا كان المستخدم مسجل دخول
        if (Auth::guard('web')->check()) {
            $userId = Auth::id();
            
            // حذف المنتج من قاعدة البيانات
            $wishlist = Wishlist::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();
    
            if ($wishlist) {
                $wishlist->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist.',
                ]);
            }
        } else {
            // إذا كان المستخدم زائر
            $wishlist = Session::get('wishlist', []);
            
            // حذف المنتج من الـ session
            if (($key = array_search($productId, $wishlist)) !== false) {
                unset($wishlist[$key]);
                Session::put('wishlist', $wishlist);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist.',
                ]);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist.',
        ]);
    }
    
    
    
}