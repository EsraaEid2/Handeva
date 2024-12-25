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
                                <a href="{{ route('single.product', $product->id) }}">
                                    <img src="{{ asset('assets/img/new-product-1.jpg') }}" alt="Products"
                                        class="img-fluid">
                                </a>
                            </figure>

                            <div class="product-details">
                                <h2><a href="{{ route('single.product', $product->id) }}">{{ $product->title }}</a></h2>
                                <div class="rating">
                                    @for ($i = 1; $i <= 5; $i++) @if ($product->avg_rating >= $i)
                                        <i class="fa fa-star"></i>
                                        @elseif ($product->avg_rating >= $i - 0.5)
                                        <i class="fa fa-star-half"></i>
                                        @else
                                        <i class="fa fa-star-o"></i>
                                        @endif
                                        @endfor
                                </div>
                                <span
                                    class="price">${{ $product->price_after_discount ? number_format($product->price_after_discount, 2) : number_format($product->price, 2) }}</span>
                                <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-add-to-cart">+ Add to
                                    Cart</a>
                                <span class="product-bedge">New</span>
                            </div>

                            <div class="product-meta">
                                <button type="button" data-toggle="modal" data-target="#quickView">
                                    <span data-toggle="tooltip" data-placement="left" title="Quick View"><i
                                            class="fa fa-compress"></i></span>
                                </button>
                                <a href="{{ route('add.to.wishlist', $product->id) }}" data-toggle="tooltip"
                                    data-placement="left" title="Add to Wishlist"><i class="fa fa-heart-o"></i></a>
                                <a href="{{ route('compare.product', $product->id) }}" data-toggle="tooltip"
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