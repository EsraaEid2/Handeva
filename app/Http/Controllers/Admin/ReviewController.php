<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    // Store a review from the user
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'nullable|string|max:500',
        ]);
 
        $product = Product::findOrFail($productId);
 
        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // Review starts as 'pending'
        ]);
 
        return redirect()->back()->with('message', 'Your review is submitted and is awaiting approval.');
    }
 
    // Admin approves the review
    public function approveReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => 'approved']);
 
        return redirect()->route('admin.reviews.index')->with('message', 'Review approved.');
    }
 
    // Admin rejects the review
    public function rejectReview($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete(); // You can also choose to soft delete if preferred
 
        return redirect()->route('admin.reviews.index')->with('message', 'Review rejected.');
    }
}