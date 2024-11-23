<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{

    public function index(Request $request)
    {
        // Search reviews
        $search = $request->input('search');
        $reviews = Review::where('status', 'pending')
            ->when($search, function ($query, $search) {
                $query->where('comment', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }
    
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
    
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'approved';
        $review->save();

        return redirect()->back()->with('successUpdate', 'Review approved successfully.');
    }

    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->delete(); // Soft delete if your model uses `SoftDeletes`

        return redirect()->back()->with('successDelete', 'Review rejected and deleted successfully.');
    }

}