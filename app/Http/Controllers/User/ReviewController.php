<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function show($productId)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->where('status', 'approved');
        }])->findOrFail($productId);
        dd($product);
        return view('theme.single-product', compact('product'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable|string|max:1000',
            'name' => 'nullable|required_if:user_id,null|string|max:255',
            'email' => 'nullable|required_if:user_id,null|email|max:255',
        ]);
        
        // Check if the user is logged in
        $userId = auth('web')->check() ? auth('web')->id() : null;
    
        // If the user is a guest, ensure the name and email are provided
        if (!$userId && !$request->filled('name')) {
            return back()->withErrors(['name' => 'Name is required for guests.']);
        }
    
        if (!$userId && !$request->filled('email')) {
            return back()->withErrors(['email' => 'Email is required for guests.']);
        }
    
        // Create the review
        Review::create([
            'product_id' => $request->product_id,
            'user_id' => $userId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'name' => $request->name,  // For guest reviews, store the name
            'email' => $request->email, // For guest reviews, store the email
        ]);
    
        return redirect()->back()->with('success', 'Review submitted and awaiting approval!');
    }
    
}