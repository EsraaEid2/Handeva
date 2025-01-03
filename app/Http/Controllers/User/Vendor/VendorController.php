<?php

namespace App\Http\Controllers\User\Vendor;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Customization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductCustomization;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
    {

        public function index()
        {
            // Fetch the vendor info
            $vendor = Auth::guard('vendor')->user();
        
            if (!$vendor) {
                return redirect()->route('vendor.dashboard')->with('error', 'Vendor not found');
            }
        
            // Fetch categories where deleted_at is null
            $categories = Category::whereNull('deleted_at')->get();
        
            // Fetch customizations with options visible to this vendor
            $customizations = Customization::with(['options'])->get();
        
            // Fetch products of the vendor
            $products = Product::where('vendor_id', $vendor->id)->with('category')->get();
        
            // Fetch reviews for the vendor's products
            $reviews = DB::table('reviews')
                ->join('products', 'reviews.product_id', '=', 'products.id')
                ->where('products.vendor_id', $vendor->id)
                ->select(
                    'reviews.rating',
                    'reviews.comment',
                    'products.title as product_title'
                )
                ->get();
        
            // Fetch custom orders for the vendor's products with customizations
            $custom_orders = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('product_customizations', 'product_customizations.product_id', '=', 'products.id')
                ->join('customizations', 'product_customizations.customization_id', '=', 'customizations.id')
                ->where('products.vendor_id', $vendor->id)
                ->select(
                    'order_items.id as order_item_id',
                    'order_items.quantity',
                    'customizations.custom_type',
                    'order_items.order_id',
                    'products.status as product_status'
                )
                ->get();
        
            // Pass data to the view
            return view('theme.vendor.dashboard', compact(
                'vendor',
                'categories',
                'customizations',
                'products',
                'reviews',
                'custom_orders'
            ));
        }
        
        public function showProfile()
        {
            $vendor = Auth::guard('vendor')->user();
            return view('theme.vendor.profile', compact('vendor'));
        }
        
        public function updateAccount(Request $request)
        {
            $vendor = Auth::guard('vendor')->user();
        
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:vendors,email,' . $vendor->id,
                'phone_number' => 'nullable|string|max:15',
                'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'bio' => 'nullable|string',
                'current_password' => 'nullable|string',
                'new_password' => 'nullable|string|min:8|confirmed',
            ]);
        
            $vendor->first_name = $request->first_name;
            $vendor->last_name = $request->last_name;
            $vendor->email = $request->email;
            $vendor->phone_number = $request->phone_number;
            $vendor->bio = $request->bio;
        
            if ($request->filled('current_password') && $request->filled('new_password')) {
                if (Hash::check($request->current_password, $vendor->password)) {
                    $vendor->password = Hash::make($request->new_password);
                } else {
                    return back()->withErrors(['current_password' => 'The current password is incorrect.']);
                }
            }
        
            if ($request->hasFile('profile_pic')) {
                if ($vendor->profile_pic) {
                    Storage::disk('public')->delete($vendor->profile_pic);
                }
                $vendor->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
            }
        
            $vendor->save();
        
            // Return success message for SweetAlert
            return back()->with('success', 'Account updated successfully!');
        }
        
        public function uploadProduct(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'stock_quantity' => 'required|integer|min:0',
                'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'customization_id' => 'required_if:is_customizable,on|exists:customizations,id', // Validate customization_id
            ]);
        
            $vendorId = Auth::id(); // Get the vendor's user ID
        
            // Calculate the price after discount if provided
            $priceAfterDiscount = $request->discount ? 
                $request->price - ($request->price * ($request->discount / 100)) : null;
        
            // Create the product
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock_quantity' => $request->stock_quantity,
                'is_traditional' => $request->has('is_traditional'),
                'is_customizable' => $request->has('is_customizable'),
                'price_after_discount' => $priceAfterDiscount,
                'vendor_id' => $vendorId,
            ]);
        
            // Upload product images
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $this->uploadImage($image, 'product_images');
        
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => $index === 0,
                ]);
            }
        
            // If the product is customizable, add the customization data
            if ($request->has('is_customizable') && $request->customization_id) {
                ProductCustomization::create([
                    'product_id' => $product->id,
                    'customization_id' => $request->customization_id,
                ]);
            }
        
            // Return success message for SweetAlert
            return redirect()->back()->with('success', 'Product uploaded successfully!');
        }
        
        
        public function updateProduct(Request $request, $id)
        {
            // Fetch the vendor and product
            $vendor = Auth::guard('vendor')->user();
            $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->first();
        
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found or unauthorized access.');
            }
        
            // Validate the input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string|max:1000',
                'stock_quantity' => 'required|numeric|min:0',
            ]);
        
            // Convert is_visible and is_customizable fields
            $validatedData['is_visible'] = $request->has('is_visible') ? 1 : 0;
            $validatedData['is_customizable'] = $request->has('is_customizable') ? 1 : 0;
        
            // Update the product
            $product->update($validatedData);
        
            // Redirect with success message for SweetAlert
            return redirect()->back()->with('success', 'Product updated successfully!');
        }
        
        
        public function destroyProduct($id)
        {
            $vendor = Auth::guard('vendor')->user();
            $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->firstOrFail();
        
            $product->deleted_at = now();
            $product->save();
        
            // Return success message after deletion
            return redirect()->route('vendor.dashboard')->with('success', 'Product deleted successfully!');
        }
        
        public function showReviews($productId)
        {
            // جلب المراجعات مع أسماء العملاء
            $reviews = DB::table('reviews')
                ->join('users', 'reviews.user_id', '=', 'users.id') // عمل join
                ->where('reviews.product_id', $productId) // مراجعات المنتج فقط
                ->select('users.first_name', 'users.last_name', 'reviews.rating', 'reviews.comment') // الأعمدة المطلوبة
                ->get();

            // إرسال البيانات إلى الصفحة
            return view('theme.vendor.sections.view_reviews', compact('reviews'));
        }

        public function showCustomOrders()
        {
            $vendor = Auth::guard('vendor')->user();
            
            // جلب طلبات التخصيص للبائع
            $customOrders = ProductCustomization::whereHas('product', function($query) use ($vendor) {
                $query->where('vendor_id', $vendor->id);
            })->with('product', 'customizationOptions')->get();

            return view('vendor.custom-orders', compact('customOrders'));
        }

        private function uploadImage($file, $folder)
        {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path("uploads/{$folder}/");
            $file->move($destinationPath, $filename);
            return "uploads/{$folder}/" . $filename;
        }
        


        
        
    }