<!-- resources/views/theme/partials/product-grid.blade.php -->
<div class="shop-page-products-wrap">
    <div class="products-wrapper">
        <div class="row">
            @foreach($products as $product)
            @if($product->is_visible)
            <div class="col-lg-4 col-sm-6">
                <div class="single-product-item text-center">
                    <figure class="product-thumb">
                        <a href="{{ route('product.showProductDetails', $product->id) }}">
                            <img src="{{ $product->primaryImage?->image_url ?? 'default-image.jpg' }}"
                                alt="{{ $product->title }}">
                        </a>
                    </figure>
                    <div class="product-details">
                        <h2><a href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a>
                        </h2>
                        <span class="price">
                            @if($product->price_after_discount)
                            <del>JOD {{ $product->price }}</del>
                            JOD {{ $product->price_after_discount }}
                            @else
                            ${{ $product->price }}
                            @endif
                        </span>
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
                        <a href="#" class="btn btn-add-to-cart btn-compare">+ Compare</a>
                    </div>
                    <div class="product-meta">
                        <button type="button" data-toggle="modal" data-target="#quickView" data-id="{{ $product->id }}">
                            <i class="fa fa-compress"></i>
                        </button>
                    </div>
                    @if($product->created_at && $product->created_at->diffInDays(now()) <= 30) <span
                        class="product-bedge">New</span>
                        @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>