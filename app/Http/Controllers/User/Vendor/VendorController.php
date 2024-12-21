<?php

namespace App\Http\Controllers\User\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

// app/Http/Controllers/VendorController.php

public function index()
{
    // Use the correct guard to get the vendor
    $vendor = Auth::guard('vendor')->user();  // Change from auth()->user()

    if (!$vendor) {
        return redirect()->route('vendor.dashboard')->with('error', 'Vendor not found');
    }

    return view('theme.vendor.dashboard', compact('vendor'));
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
        // التحقق من المدخلات
        $validated = $request->validate([
            'product.title' => 'required|string|max:255',
            'product.description' => 'required|string',
            'product.price' => 'required|numeric',
            'product.image' => 'required|image|max:1024', // الصورة لا تتجاوز 1MB
        ]);

        // تحميل الصورة
        $imageUrl = $request->file('product.image')->store('product_images', 'public');

        // تخزين المنتج في قاعدة البيانات
        Product::create([
            'title' => $request->product['title'],
            'description' => $request->product['description'],
            'price' => $request->product['price'],
            'image_url' => $imageUrl,
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->product['category_id'], // تأكد من أن هذه القيمة موجودة في النموذج
            'is_traditional' => $request->product['is_traditional'],
            'is_customizable' => $request->product['is_customizable'],
            'price_after_discount' => $request->product['price_after_discount'], // حفظ السعر بعد الخصم
        ]);

        session()->flash('message', 'Product uploaded successfully.');
        return redirect()->route('vendor.dashboard');
    }

}