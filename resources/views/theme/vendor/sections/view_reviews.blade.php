<table id="reviews-table" class="table">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Product</th>
            <th>Rating</th>
            <th>Comment</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
        <tr>
            <td>{{ $review->first_name . ' ' . $review->last_name }}</td> <!-- اسم العميل -->
            <td>{{ $review->product_title }}</td> <!-- اسم المنتج -->
            <td>{{ $review->rating }}</td> <!-- التقييم -->
            <td>{{ $review->comment }}</td> <!-- التعليق -->
        </tr>
        @empty
        <tr>
            <td colspan="4">No reviews found for your products.</td>
        </tr>
        @endforelse
    </tbody>
</table>