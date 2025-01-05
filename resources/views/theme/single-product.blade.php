@extends('theme.master')
@section('title','Product Details')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="handeva-container">
        <div class="row">
            <!-- Single Product Page Content Start -->
            <div class="col-lg-12">
                <div class="single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel">
                                    @foreach($product->productImages->take(3) as $image)
                                    <div class="single-thumb-item">
                                        <a href="{{ route('product.showProductDetails', ['id' => $product->id]) }}">
                                            <img class="img-fluid" src="{{ asset($image->image_url) }}"
                                                alt="Product Image" />
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7 mt-5 mt-lg-0">
                            <div class="ep-details-wrap">
                                <div class="ep-btn-group tr-0">
                                    <a href="{{ route('wishlist.add', $product->id) }}"
                                        class="ep-meta-btn add-to-wishlist" data-product-id="{{ $product->id }}"
                                        title="Add to Wishlist">
                                        <i class="fa fa-heart empty-heart" id="wishlist-icon-{{ $product->id }}"></i>
                                    </a>
                                </div>
                                <h1 class="ep-title">{{ $product->title }}</h1>
                                <div class="ep-rating">
                                    @for ($i = 1; $i <= 5; $i++) <span
                                        class="ep-star {{ $i <= ceil($product->avg_rating) ? '' : 'empty' }}">
                                        &#9733;</span>
                                        @endfor
                                </div>
                                <p class="ep-description">{{ $product->description }}</p>
                                <div class="ep-additional-info">
                                    <div class="product-info-stock-sku">
                                        <span
                                            class="product-stock-status {{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>

                                    @if($product->is_traditional)
                                    <strong>Traditional Accessory</strong>
                                    @endif

                                    @if ($product->is_customizable)
                                    <span class="ep-customizable">
                                        <i class="fa fa-paint-brush"></i> Customized
                                    </span>

                                    <!-- Display customization options for ID=4 -->
                                    @if ($customizations->isNotEmpty())
                                    @foreach ($customizations as $customization)
                                    <p><strong>{{ $customization['custom_type'] }}</strong></p>

                                    @if ($customization['options']->isNotEmpty())
                                    <label for="custom-options-{{ $customization['id'] }}">Choose an option:</label>
                                    <select id="custom-options-{{ $customization['id'] }}" class="form-control">
                                        @foreach ($customization['options'] as $option)
                                        <option value="{{ $option['id'] }}">{{ $option['option_value'] }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <p>No customization options available.</p>
                                    @endif
                                    @endforeach
                                    @else
                                    <p>No customizations available for this product.</p>
                                    @endif
                                    @endif
                                </div>


                                <div class="ep-price">
                                    @if($product->price_after_discount)
                                    <span>JOD {{ $product->price_after_discount }}</span>
                                    <span class="ep-price-original">JOD {{ $product->price }}</span>
                                    @else
                                    <span>JOD {{ $product->price }}</span>
                                    @endif
                                </div>
                                <!-- Quantity and Buttons -->

                                <meta name="cart-add-route" content="{{ route('cart.add') }}">

                                <div class="ep-product-quantity d-flex align-items-center mt-4">
                                    <div class="ep-quantity-field mr-3">
                                        <label for="qty">Quantity</label>
                                        <div class="item-quantity">
                                            <button class="quantity-btn decrease">−</button>
                                            <input type="number" value="1" min="1"
                                                max="{{ $product['stock_quantity'] }}" class="quantity-input">
                                            <button class="quantity-btn increase">+</button>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="ep-add-to-cart" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-shopping-bag"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- Product Details End -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Product Full Description Start -->
                                <div class="custom-product-full-info-reviews">
                                    <!-- Single Product tab Menu -->
                                    <nav class="nav" id="custom-nav-tab">
                                        <a class="active" id="custom-reviews-tab" data-toggle="tab"
                                            href="#custom-reviews">Reviews</a>
                                    </nav>
                                    <!-- Single Product tab Menu -->

                                    <!-- Single Product tab Content -->
                                    <div class="tab-content" id="custom-nav-tabContent">
                                        <div class="tab-pane fade show active" id="custom-reviews">
                                            <div class="row">
                                                <!-- Review Form Start -->
                                                <div class="col-lg-6">
                                                    <div class="custom-review-form-wrapper">
                                                        <h3>Add Your Review</h3>
                                                        <form action="{{ route('reviews.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <div class="custom-review-form row">
                                                                <!-- Star Rating Section -->
                                                                <div class="col-12 mb-4">
                                                                    <h5>Rating:</h5>
                                                                    <div id="stars" class="star-rating">
                                                                        <i class="fa fa-star bi-star"
                                                                            data-index="1"></i>
                                                                        <i class="fa fa-star bi-star"
                                                                            data-index="2"></i>
                                                                        <i class="fa fa-star bi-star"
                                                                            data-index="3"></i>
                                                                        <i class="fa fa-star bi-star"
                                                                            data-index="4"></i>
                                                                        <i class="fa fa-star bi-star"
                                                                            data-index="5"></i>
                                                                    </div>
                                                                    <input type="hidden" name="rating" id="stars-input"
                                                                        required>
                                                                </div>

                                                                <!-- Name Input -->
                                                                <div class="col-md-6 col-12 mb-4">
                                                                    <label for="name">Name:</label>
                                                                    <input id="name" name="name" placeholder="Name"
                                                                        type="text" required>
                                                                </div>

                                                                <!-- Email Input -->
                                                                <div class="col-md-6 col-12 mb-4">
                                                                    <label for="email">Email:</label>
                                                                    <input id="email" name="email" placeholder="Email"
                                                                        type="email" required>
                                                                </div>

                                                                <!-- Review Comment -->
                                                                <div class="col-12 mb-4">
                                                                    <label for="comment">Your Review:</label>
                                                                    <textarea name="comment" id="comment"
                                                                        placeholder="Write a review"
                                                                        required></textarea>
                                                                </div>

                                                                <!-- Submit Button -->
                                                                <div class="col-12">
                                                                    <input value="Add Review" type="submit">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Review Form End -->

                                                <!-- Reviews Display Start -->
                                                <div class="col-lg-6">
                                                    <div class="custom-reviews-display-wrapper">
                                                        <!-- Average Rating and Overall Comments -->
                                                        <div class="custom-pro-avg-rating">
                                                            <h4>
                                                                @if ($reviews->total() > 0)
                                                                {{ number_format($reviews->avg('rating'), 1) }}
                                                                <span>(Overall)</span>
                                                                @else
                                                                No ratings yet
                                                                @endif
                                                            </h4>
                                                            <span>
                                                                Based on {{ $reviews->total() }}
                                                                {{ $reviews->total() == 1 ? 'Comment' : 'Comments' }}
                                                            </span>
                                                        </div>

                                                        <!-- Reviews List -->
                                                        <div class="custom-reviews-list">
                                                            @foreach ($reviews as $review)
                                                            <div class="custom-single-review">
                                                                <!-- Review Author -->
                                                                <div class="custom-review-author">
                                                                    <h3>{{ $review->user->name ?? 'Guest' }}</h3>
                                                                    <div class="custom-rating-stars">
                                                                        <!-- Filled Stars -->
                                                                        @for ($i = 1; $i <= $review->rating; $i++)
                                                                            <i class="fa fa-star"></i>
                                                                            @endfor
                                                                            <!-- Empty Stars -->
                                                                            @for ($i = $review->rating + 1; $i <= 5;
                                                                                $i++) <i class="fa fa-star-o"></i>
                                                                                @endfor
                                                                                <span>({{ $review->rating }})</span>
                                                                    </div>
                                                                </div>
                                                                <!-- Review Comment -->
                                                                <p>{{ $review->comment }}</p>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                        <!-- Pagination for Reviews -->
                                                        <div class="custom-page-pagination">
                                                            {{ $reviews->links('pagination::bootstrap-4') }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- Reviews Display End -->
                                        </div>
                                    </div>
                                    <!-- Single Product tab Content -->
                                </div>
                                <!-- Product Full Description End -->
                            </div>
                        </div>
                    </div>


                </div>
                <!-- Single Product Page Content End -->
            </div>
        </div>
    </div>
    <!--== Page Content Wrapper End ==-->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to Cart functionality
        document.querySelector('.ep-add-to-cart').addEventListener('click', function(e) {
            e.preventDefault();

            const productId = this.getAttribute('data-product-id');
            const quantityInput = document.querySelector('.quantity-input');
            const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;

            const route = document.querySelector('meta[name="cart-add-route"]').getAttribute('content');

            fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message); // Replace with SweetAlert if needed
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        // Quantity increment/decrement functionality
        document.querySelectorAll('.item-quantity').forEach((quantityContainer) => {
            const decreaseButton = quantityContainer.querySelector('.decrease');
            const increaseButton = quantityContainer.querySelector('.increase');
            const inputField = quantityContainer.querySelector('.quantity-input');

            decreaseButton.addEventListener('click', () => {
                const currentValue = parseInt(inputField.value, 10);
                if (currentValue > parseInt(inputField.min, 10)) {
                    inputField.value = currentValue - 1;
                }
            });

            increaseButton.addEventListener('click', () => {
                const currentValue = parseInt(inputField.value, 10);
                if (currentValue < parseInt(inputField.max, 10)) {
                    inputField.value = currentValue + 1;
                }
            });
        });

        // Owl Carousel initialization
        $(".product-thumb-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });
    </script>

    @endsection