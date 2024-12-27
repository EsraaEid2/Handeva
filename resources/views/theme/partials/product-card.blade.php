<div class="single-product-item product-card text-center">
    <figure class="product-thumb">
        <a href="{{ route('product.showProductDetails', $product->id) }}">
            <img src="{{ $product->primaryImage ? asset($product->primaryImage->image_url) : asset('img/clothing.jpg') }}"
                alt="Products" class="img-fluid">
        </a>
    </figure>

    <div class=" product-details">
        <h2><a href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a></h2>
        <div class="rating">
            @if($product->avg_rating > 0)
            @for ($i = 1; $i <= 5; $i++) <span class="star {{ $i <= ceil($product->avg_rating) ? 'filled' : '' }}">
                &#9733;</span>
                @endfor
                @else
                No ratings yet
                @endif
        </div>

        <!-- Price Section -->
        <span class="price">
            @if($product->price_after_discount)
            <del>JOD {{ $product->price }}</del>
            JOD {{ $product->price_after_discount }}
            @else
            JOD {{ $product->price }}
            @endif
        </span>

        <!-- Add to Cart and Wishlist -->
        @if($product->stock_quantity > 0)
        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-add-to-cart">+ Add to Cart</a>
        @else
        <span class="text-danger">Out of Stock</span>
        @endif
        <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-add-to-cart btn-whislist">+ Wishlist</button>
        </form>
        <!-- Compare Button -->
        <a href="#" class="btn btn-add-to-cart btn-compare">+ Compare</a>

        @if (!is_null($product->price_after_discount))
        <span class="product-bedge sale">Sale</span>
        @endif
    </div>

    <div class="product-meta">
        <button type="button" data-toggle="modal" data-target="#quickView">
            <span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="fa fa-compress"></i></span>
        </button>
        <a href="{{ route('wishlist.add', $product->id) }}" data-toggle="tooltip" data-placement="left"
            title="Add to Wishlist"><i class="fa fa-heart-o wishlist-icon"></i></a>
        <a href="{{ route('cart.add', $product->id) }}" data-toggle="tooltip" data-placement="left" title="Compare"><i
                class="fa fa-tags"></i></a>
    </div>
</div>

<script>
document.querySelectorAll('.product-meta .fa-heart-o').forEach(function(heartIcon) {
    heartIcon.addEventListener('click', function() {
        this.classList.toggle('fa-heart');
        this.classList.toggle('fa-heart-o');
    });
});
</script>