<?php

namespace App\Http\Controllers\User\Vendor;
use Illuminate\Support\Facades\DB;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
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
        
            // جلب الفئات من قاعدة البيانات
            $categories = Category::all();
            $customizations = ProductCustomization::all();
        
            // جلب المنتجات الخاصة بالبائع
            $products = Product::where('vendor_id', $vendor->id)->with('category')->get();
        
            // جلب المراجعات الخاصة بمنتجات البائع
            $reviews = DB::table('reviews')
                ->join('products', 'reviews.product_id', '=', 'products.id') // الربط مع جدول المنتجات
                ->join('users', 'reviews.user_id', '=', 'users.id') // الربط مع جدول المستخدمين لجلب اسم العميل
                ->where('products.vendor_id', $vendor->id) // التحقق من أن المنتج يخص البائع
                ->select(
                    'reviews.rating',
                    'reviews.comment',
                    'products.title as product_title',
                    'users.first_name',
                    'users.last_name'
                )
                ->get();
        
            // جلب الطلبات المخصصة (custom_orders) للمنتجات الخاصة بالبائع
            $custom_orders = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('product_customization', 'order_items.customization_id', '=', 'products.id') // التصحيح هنا
                ->where('products.vendor_id', $vendor->id)
                ->select(
                    'order_items.id as order_item_id',
                    'order_items.quantity',
                    'product_customization.custom_type', // تصحيح الاسم هنا
                    'order_items.order_id',
                    'products.status as customization_status' // تصحيح الاسم هنا
                )
                ->get();
        
            // تمرير البيانات إلى الـ View
            return view('theme.vendor.dashboard', compact('vendor', 'categories', 'customizations', 'products', 'reviews', 'custom_orders'));
    }
        
        public function updateAccount(Request $request)
        {
            // جلب بيانات البائع من الـ guard المخصص للبائعين
            $vendor = Auth::guard('vendor')->user();
            // التحقق من صحة البيانات
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:vendors,email,' . $vendor->id, // تحقق من البريد الإلكتروني مع استثناء الحالي
                'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'bio' => 'nullable|string',
                'social_links' => 'nullable|string',
            ]);
          
            // تحقق إذا كان البريد الإلكتروني قد تم تغييره
            if ($request->email !== $vendor->email) {
                // إذا تم تغييره، تأكد من أنه فريد في قاعدة البيانات
                $request->validate([
                    'email' => 'unique:vendors,email',
                ]);
            }
            
            // تحديث البيانات
            $vendor->first_name = $request->first_name;
            $vendor->last_name = $request->last_name;
            $vendor->email = $request->email;
            $vendor->bio = $request->bio;
            $vendor->social_links = $request->social_links;
            
            // رفع الصورة إذا كانت موجودة
            if ($request->hasFile('profile_pic')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($vendor->profile_pic) {
                    Storage::delete($vendor->profile_pic);
                }
            
                // رفع الصورة الجديدة
                $path = $request->file('profile_pic')->store('vendor/profile_pictures', 'public');
                $vendor->profile_pic = $path;
            }
            
            // حفظ التحديثات في قاعدة البيانات
            $vendor->save();
            // dd( $vendor->save());
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
            ]);
        
            $vendorId = Auth::id(); // الحصول على معرف المستخدم
        
            // حساب السعر بعد الخصم إذا وجد
            $priceAfterDiscount = $request->discount ? 
                $request->price - ($request->price * ($request->discount / 100)) : null;
        
            // إنشاء المنتج
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
        
            // رفع الصور
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $this->uploadImage($image, 'product_images');
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => $index === 0,
                ]);
            }
        
            return redirect()->back()->with('success', 'Product uploaded successfully!');
        }
        
        public function updateProduct(Request $request, $id)
        {
            // التحقق من صلاحية الـVendor
            $vendor = Auth::guard('vendor')->user();
            $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->first();
        
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found or unauthorized access.');
            }
        
            // التحقق من البيانات المدخلة
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string|max:1000',
                'stock_quantity' => 'required|numeric|min:0', // إضافة التحقق لحقل stock_quantity
            ]);
        
            // تحويل قيم الحقول is_visible و is_customizable
            $validatedData['is_visible'] = $request->has('is_visible') ? 1 : 0;
            $validatedData['is_customizable'] = $request->has('is_customizable') ? 1 : 0;
        
            // تحديث بيانات المنتج
            $product->update($validatedData);
        
            // إعادة توجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'Product updated successfully!');
        }
        
        public function destroyProduct($id)
        {
            $vendor = Auth::guard('vendor')->user();
            $product = Product::where('id', $id)->where('vendor_id', $vendor->id)->firstOrFail();

            $product->deleted_at = now();
            $product->save();

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