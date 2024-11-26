<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ReviewController extends Controller
{
    // Display reviews
    public function index(Request $request)
    {
        $status = $request->get('status'); // Get the selected status filter
    
        // Build the query
        $reviews = Review::query()
            ->when($status, function ($query) use ($status) {
                // Filter reviews by status if a status is selected
                return $query->where('status', $status);
            })
            ->paginate(10); // Paginate the results
    
        return view('admin.reviews.index', compact('reviews'));
    }
    

    // Store a new review
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted for approval.');
    }

    // Approve a review
    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Review approved successfully.');
    }

    // Reject a review
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'rejected']); // Update status to rejected
    
        return redirect()->back()->with('success', 'Review rejected successfully.');
    }
    
}