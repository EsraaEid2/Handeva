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
        
        // Ensure the product ID is sent within the request
        if (!$productId) {
            return response()->json([
                'success' => false,
                'message' => 'Product ID is required.',
            ]);
        }
    
        if (Auth::guard('web')->check()) {
            $userId = Auth::id();
    
            // Check if the product exists in the database
            $product = Product::find($productId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ]);
            }
    
            // Check if the product is already in the user's wishlist
            $existingWishlistItem = Wishlist::where('user_id', $userId)
                                            ->where('product_id', $productId)
                                            ->first();
    
            \Log::info('Existing Wishlist Item:', ['item' => $existingWishlistItem]);

            if ($existingWishlistItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist.',
                ]);
            }
    
            // Add the product to the wishlist
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
    
            // Get the updated wishlist count
            $wishlistCount = Wishlist::where('user_id', $userId)->count();
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist.',
                'wishlistCount' => $wishlistCount, // Send updated wishlist count
            ]);
        } else {
            // If the user is a guest
            $wishlist = Session::get('wishlist', []);
                    
            // Check if the product is already in the wishlist
            if (in_array($productId, $wishlist)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist.',
                ]);
            }
            \Log::info('Guest Wishlist Before Adding:', $wishlist);

    
            // Add the product to the session wishlist
            $wishlist[] = $productId;
            Session::put('wishlist', $wishlist);
            // \Log::info(Session::get('wishlist'));

            // Return the updated count from the session wishlist
            $wishlistCount = count($wishlist);
    
            return response()->json([
                'success' => true,
                'message' => 'Product added to wishlist.',
                'wishlistCount' => $wishlistCount, // Send updated wishlist count
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
         $wishlistItems = [];
     
         if (Auth::guard('web')->check()) {
             // Authenticated user
             $userId = Auth::id();
     
             // Fetch wishlist products with primary image and pagination
             $wishlistItems = Product::join('wishlists', 'products.id', '=', 'wishlists.product_id')
                 ->leftJoin('product_images', function ($join) {
                     $join->on('products.id', '=', 'product_images.product_id')
                         ->where('product_images.is_primary', true);
                 })
                 ->where('wishlists.user_id', $userId)
                 ->where('wishlists.is_deleted', false)
                 ->where('products.is_visible', true)
                 ->distinct() // Ensure no duplicates
                 ->select(
                     'products.id',
                     'products.title',
                     'products.price',
                     'products.stock_quantity',
                     'products.price_after_discount',
                     'product_images.image_url as primary_image'
                 )
                 ->paginate(10); // Add pagination, 10 items per page
     
             // Optionally, you can log the result for debugging
            //  dd($wishlistItems);
         } else {
             // Guest user
             $wishlist = Session::get('wishlist', []); // Get wishlist from session
     
             if (!empty($wishlist)) {
                 // Fetch products for guest's wishlist with pagination
                 $wishlistItems = Product::leftJoin('product_images', function ($join) {
                     $join->on('products.id', '=', 'product_images.product_id')
                         ->where('product_images.is_primary', true);
                 })
                     ->whereIn('products.id', $wishlist)
                     ->where('products.is_visible', true) // Only visible products
                     ->select(
                         'products.id',
                         'products.title',
                         'products.price',
                         'products.price_after_discount',
                         'product_images.image_url as primary_image'
                     )
                     ->paginate(10); // Add pagination, 10 items per page
             }
         }
     
         // Return the wishlist view with pagination data
         return view('theme.wishlist', ['wishlistItems' => $wishlistItems]);
     }
     
    /**
     * Remove a product from the wishlist.
     */
    public function removeFromWishlist($productId)
    {
        // تأكد من إرسال معرف المنتج
        if (!$productId) {
            return response()->json([
                'success' => false,
                'message' => 'Product ID is required.',
            ]);
        }
    
        if (Auth::guard('web')->check()) {
            $userId = Auth::id();
    
            // حذف المنتج من قاعدة البيانات
            $wishlist = Wishlist::where('user_id', $userId)
                                 ->where('product_id', $productId)
                                 ->first();
    
            if ($wishlist) {
                $wishlist->delete();
    
                // Get the updated wishlist count
                $wishlistCount = Wishlist::where('user_id', $userId)->count();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist.',
                    'wishlistCount' => $wishlistCount, // Send updated wishlist count
                ]);
            }
        } else {
            // إذا كان المستخدم زائر
            $wishlist = Session::get('wishlist', []);
    
            // حذف المنتج من الـ session
            if (($key = array_search($productId, $wishlist)) !== false) {
                unset($wishlist[$key]);
                Session::put('wishlist', $wishlist);
    
                // Return updated count from session wishlist
                $wishlistCount = count($wishlist);
    
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist.',
                    'wishlistCount' => $wishlistCount, // Send updated wishlist count
                ]);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist.',
        ]);
    }
    
     
    
    
    
}