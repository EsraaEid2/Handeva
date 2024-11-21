<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Display a list of products
    public function index()
    {
        $products = Product::with(['category', 'vendor'])->get(); // eager load relationships
        return view('admin.products.index', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        return view('admin.products.create', compact('categories', 'vendors'));
    }

    // Store a newly created product
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer',
            'vendor_id' => 'required|exists:vendors,id',
            'is_visible' => 'required|boolean',
            'is_traditional' => 'required|boolean',
            'is_customizable' => 'required|boolean',
            'price_after_discount' => 'nullable|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }


    // Show the form for editing a product
    public function edit(Product $product)
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        return view('admin.products.edit', compact('product', 'categories', 'vendors'));
    }


    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock_quantity' => 'required|integer',
            'vendor_id' => 'required|exists:vendors,id',
            'is_visible' => 'required|boolean',
            'is_traditional' => 'required|boolean',
            'is_customizable' => 'required|boolean',
            'price_after_discount' => 'nullable|numeric|gte:0|lt:' . $request->price, // Ensure discount price is valid
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);
    
        // Handle Profile Picture Upload (if new picture is uploaded)
        if ($request->hasFile('profile_pic')) {
            // Delete the old image if it exists
            if ($product->profile_pic && Storage::exists('public/' . $product->profile_pic)) {
                Storage::delete('public/' . $product->profile_pic);
            }
    
            // Store new image
            $imagePath = $request->file('profile_pic')->store('products', 'public');
        } else {
            // If no new image, keep the old one
            $imagePath = $product->profile_pic;
        }
    
        // Update product with new data
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'stock_quantity' => $request->stock_quantity,
            'vendor_id' => $request->vendor_id,
            'is_visible' => $request->has('is_visible'),
            'is_traditional' => $request->has('is_traditional'),
            'is_customizable' => $request->has('is_customizable'),
            'price_after_discount' => $request->price_after_discount, // if provided
            'profile_pic' => $imagePath, // Store the image path
        ]);
    
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }


    // Show product details
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // Delete a product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

}