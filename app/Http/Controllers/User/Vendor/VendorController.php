<?php

namespace App\Http\Controllers\User\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

// app/Http/Controllers/VendorController.php

public function index()
{
    // جلب المستخدم الحالي
    $user = auth()->user();

    // محاولة جلب البائع باستخدام البريد الإلكتروني للمستخدم
    $vendor = Vendor::where('email', $user->email)->first();

    if (!$vendor) {
        // إذا لم يتم العثور على البائع، يمكنك إعادة توجيه المستخدم أو عرض رسالة خطأ
        return redirect()->route('vendor.dashboard')->with('error', 'Vendor not found');
    }

    // إرسال بيانات البائع إلى الـ View
    return view('theme.vendor.dashboard', compact('vendor'));
}


    public function updateAccount(Request $request)
    {
        $vendor = auth()->user()->vendor; // جلب بيانات البائع

        // التحقق من صحة البيانات
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_links' => 'nullable|url',
            'bio' => 'nullable|string',
        ]);

        // تحديث البيانات
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;
        $vendor->social_links = $request->social_links;
        $vendor->bio = $request->bio;

        // تحديث الصورة الشخصية إذا تم رفعها
        if ($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profile_pics', 'public');
            $vendor->profile_pic = $imagePath;
        }

        $vendor->save(); // حفظ التغييرات

        // إعادة توجيه مع رسالة نجاح
        return redirect()->route('vendor.dashboard')->with('success', 'Account updated successfully');
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