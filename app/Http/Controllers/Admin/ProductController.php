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
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::with(['primaryImage']) // Load primary image
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%$search%");
            })
            ->get(); // استخدم get() بدلاً من paginate()
    
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

        return redirect()->route('admin.products.index')->with('successAdd', 'Product created successfully!');
    }


    // Show the form for editing a product
    public function edit(Product $product)
    {
        $categories = Category::all();
        $vendors = Vendor::all();
        return view('admin.products.edit', compact('product', 'categories', 'vendors'));
    }


    // Update a product
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'stock_quantity' => 'required|integer',
            'is_customizable' => 'required|boolean',
        ]);
    
        $product = Product::findOrFail($id);
        $product->update($validatedData);
    
        return redirect()->back()->with('successUpdate', 'Product updated successfully');
    }
    

    // Show product details
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

   // Soft delete a product
   public function destroy(Product $product)
   {
       $product->delete();
       return response()->json(['success' => true, 'successDelete' => 'Product deleted successfully!']);
   }

   public function restore($id)
   {
       $product = Product::withTrashed()->find($id);
       if ($product) {
           $product->restore();
           return redirect()->route('admin.products.index')->with('success', 'Product restored successfully!');
       }

       return redirect()->route('admin.products.index')->with('error', 'Product not found.');
   }

}