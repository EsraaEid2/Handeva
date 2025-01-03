<div class="reviews-container">
    <table id="reviews-table" class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Rating</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
            <tr>
                <td>{{ $review->product_title }}</td>
                <td>
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++) <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">
                            &#9733;</span>
                            @endfor
                    </div>
                </td>
                <td>{{ $review->comment }}</td>
            </tr>
            @empty
            <tr class="empty-state">
                <td colspan="3">No reviews found for your products.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>