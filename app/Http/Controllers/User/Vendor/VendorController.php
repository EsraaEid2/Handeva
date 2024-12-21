<?php

namespace App\Http\Controllers\User\Vendor;
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
        // جلب معلومات البائع
        $vendor = Auth::guard('vendor')->user(); 
    
        if (!$vendor) {
            return redirect()->route('vendor.dashboard')->with('error', 'Vendor not found');
        }
    
        // جلب الفئات من قاعدة البيانات
        $categories = Category::all();
        $customizations = ProductCustomization::all();
        $products = Product::where('vendor_id', $vendor->id)->with('category')->get();
    
        // تمرير البيانات إلى الـ View
        return view('theme.vendor.dashboard', compact('vendor', 'categories','customizations','products'));
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
    
        $vendorId = Auth::id(); // يمكن الحصول على الـ ID مباشرة لأن الميدل وير يضمن أن المستخدم هو Vendor
    
        // حساب السعر بعد الخصم إذا كان هناك خصم
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
            $path = $image->store('product_images', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
                'is_primary' => $index === 0, // الصورة الأولى هي الرئيسية
            ]);
        }
    
        // إرجاع رسالة النجاح
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
    
        // عرض محتوى الطلب للتأكد من القيم المرسلة
        // dd($request->all());
    
        // التحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
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


    
    
}