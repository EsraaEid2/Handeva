<!--== New Products Area Start ==-->
<section id="new-products-area" class="p-9">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2>New Products</h2>
                    <p>Trending stunning Unique</p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="products-wrapper">
                    <div class="new-products-carousel owl-carousel">
                        @foreach ($products as $product)
                        <div class="single-product-item text-center">
                            <figure class="product-thumb">
                                <a href="{{ route('product.showProductDetails', $product->id) }}">
                                    <img src="{{ asset('assets/img/new-product-1.jpg') }}" alt="Products"
                                        class="img-fluid">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h2><a
                                        href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a>
                                </h2>
                                <div class="rating">
                                    @if($product->avg_rating > 0)
                                    @for ($i = 1; $i <= 5; $i++) <span
                                        class="star {{ $i <= ceil($product->avg_rating) ? 'filled' : '' }}">
                                        &#9733;</span>
                                        @endfor
                                        @else
                                        No ratings yet
                                        @endif
                                </div>

                                <span class="price">JOD
                                    {{ $product->price_after_discount ? number_format($product->price_after_discount, 2) : number_format($product->price, 2) }}</span>
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-add-to-cart">+ Add to
                                    Cart</a>
                                @if (!is_null($product->price_after_discount))
                                <span class="product-bedge sale">Sale</span>
                                @endif
                            </div>

                            <div class="product-meta">
                                <button type="button" data-toggle="modal" data-target="#quickView">
                                    <span data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                            class="fa fa-compress"></i></span>
                                </button>
                                <a href="{{ route('wishlist.add', $product->id) }}" data-toggle="tooltip"
                                    data-placement="left" title="Add to Wishlist"><i class="fa fa-heart-o"></i></a>
                                <a href="{{ route('cart.add', $product->id) }}" data-toggle="tooltip"
                                    data-placement="left" title="Compare"><i class="fa fa-tags"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== New Products Area End ==-->