<div class="shop-page-products-wrap">
    <div class="products-wrapper">
        <div class="row">
            @foreach($products as $product)
            @if($product->is_visible)
            <div class="col-lg-4 col-sm-6">
                <div class="single-product-item text-center">
                    <figure class="product-thumb">
                        <a href="{{ route('product.showProductDetails', $product->id) }}">
                            <img src="{{ $product->primaryImage?->image_url ?? 'new-product-1.jpg' }}"
                                alt="{{ $product->title }}" class="img-fluid">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h2><a href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a>
                        </h2>

                        <!-- Rating Section -->
                        <div class="rating">
                            @if($product->avg_rating > 0)
                            @for ($i = 1; $i <= 5; $i++) <span
                                class="star {{ $i <= ceil($product->avg_rating) ? 'filled' : '' }}">&#9733;</span>
                                @endfor
                                @else
                                <span>No ratings yet</span>
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

                        <!-- Sale Badge -->
                        @if (!is_null($product->price_after_discount))
                        <span class="product-bedge sale">Sale</span>
                        @endif
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta">
                        <button type="button" data-toggle="modal" data-target="#quickView" data-id="{{ $product->id }}">
                            <i class="fa fa-compress"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>