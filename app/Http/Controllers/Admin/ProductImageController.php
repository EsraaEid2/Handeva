<?php


namespace App\Http\Controllers;


use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    // Show the form to add images to a product
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('admin.product_images.create', compact('product'));
    }

    // Store the new product image
    public function store(Request $request, $productId)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_primary' => 'boolean',
        ]);

        $image = $request->file('image_url');
        $imagePath = $image->store('product_images', 'public'); // Store the image

        ProductImage::create([
            'product_id' => $productId,
            'image_url' => $imagePath,
            'is_primary' => $request->input('is_primary', false),
        ]);

        return redirect()->route('admin.products.show', $productId)->with('success', 'Image added successfully!');
    }

    // Show all images for a product
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $images = $product->images; // Assuming the relationship is defined
        return view('admin.product_images.index', compact('product', 'images'));
    }

    // Delete an image
    public function destroy($productId, $imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        $image->delete();

        return redirect()->route('admin.products.show', $productId)->with('success', 'Image deleted successfully!');
    }
}