<div class="ep-product-card">
    <div class="ep-product-image">
        <a href="{{ route('product.showProductDetails', $product->id) }}">
            <img src="{{ $product->primaryImage ? asset($product->primaryImage->image_url) : asset('img/clothing.jpg') }}"
                alt="Products">
        </a>
        @if (!is_null($product->price_after_discount))
        <span class="ep-sale-badge">Sale</span>
        @endif
        <div class="ep-product-meta">
            <button type="button" class="ep-meta-btn ep-quick-view" data-toggle="modal" data-target="#quickView"
                data-product="{{ json_encode($product) }}">
                <span data-toggle="tooltip" data-placement="left" title="Quick View">
                    <i class="fa fa-eye"></i>
                </span>
            </button>

            <a href="{{ route('wishlist.add', $product->id) }}" class="ep-meta-btn" title="Add to Wishlist"><i
                    class="fa fa-heart"></i></a>
        </div>
    </div>

    <div class="ep-product-details">
        <h2 class="ep-product-title">
            <a href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a>
        </h2>

        @if ($product->is_customizable)
        <span class="ep-customizable">
            <i class="fa fa-paint-brush"></i> Customized
        </span>
        @endif

        <div class="ep-rating">
            @if ($product->avg_rating > 0)
            @for ($i = 1; $i <= 5; $i++) <span class="ep-star {{ $i <= ceil($product->avg_rating) ? '' : 'empty' }}">
                ★</span>
                @endfor
                @else
                <span>No ratings yet</span>
                @endif
        </div>

        <span class="ep-price">
            @if (!is_null($product->price_after_discount))
            <span class="ep-price-discount">JOD {{ number_format($product->price_after_discount, 2) }}</span>
            <del class="ep-price-original">JOD {{ number_format($product->price, 2) }}</del>
            @else
            JOD {{ number_format($product->price, 2) }}
            @endif
        </span>

        <a href="{{ route('cart.add', $product->id) }}" class="ep-add-to-cart">
            <i class="fa fa-shopping-cart"></i> Add to Cart
        </a>
    </div>
</div>