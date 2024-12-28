@extends('theme.master')
@section('title','Single-product')
@section('content')

@include('theme.partials.hero',['title' => 'Product'])

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
                                        <a href="single-product.html">
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
                                    <p><strong> {{ $product->productCustomization->custom_type }}</strong>
                                    </p>
                                    <!-- Customizable Product -->
                                    @if($product->productCustomization->customizationOptions->isNotEmpty())
                                    <label for="custom-options">Choose an option:</label>
                                    <select id="custom-options" class="form-control">
                                        @foreach($product->productCustomization->customizationOptions as $option)
                                        <option value="{{ $option->id }}">{{ $option->option_value }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <p>No customization options available.</p>
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
                                <div class="ep-product-quantity d-flex align-items-center mt-4">
                                    <div class="ep-quantity-field mr-3">
                                        <label for="qty">Quantity</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="decrease-qty">-</button>
                                            <input type="number" id="qty" min="1" max="{{ $product->stock_quantity }}"
                                                value="1" />
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="increase-qty">+</button>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('cart.add', $product->id) }}" class="ep-btn ep-btn-cart"> <i
                                                class="fa fa-shopping-cart"></i> Add to Cart</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="ep-btn-group">
                                        <button class="ep-btn ep-btn-wishlist" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-heart"></i> Add to Wishlist
                                        </button>

                                        <button class="ep-btn ep-btn-compare"><i class="fa fa-exchange-alt"></i> Add to
                                            Compare</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Details End -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Product Full Description Start -->
                                <div class="product-full-info-reviews">
                                    <!-- Single Product tab Menu -->
                                    <nav class="nav" id="nav-tab">
                                        <a class="active" id="description-tab" data-toggle="tab"
                                            href="#description">Description</a>
                                        <a id="reviews-tab" data-toggle="tab" href="#reviews">Reviews</a>
                                    </nav>
                                    <!-- Single Product tab Menu -->

                                    <!-- Single Product tab Content -->
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="description">
                                            <p>Stay comfortable and stay in the race no matter what the weather's up
                                                to.
                                                The
                                                Bruno Compete Hoodie's water-repellent exterior shields you from the
                                                elements, while advanced fabric technology inside wicks moisture to
                                                keep
                                                you
                                                dry.Stay comfortable and stay in the race no matter what the
                                                weather's
                                                up
                                                to. The Bruno Compete Hoodie's water-repellent exterior shields you
                                                from
                                                the
                                                elements, while advanced fabric technology inside wicks moisture to
                                                keep
                                                you
                                                dry.Stay comfortable and stay in the race no matter what the
                                                weather's
                                                up
                                                to. The Bruno Compete Hoodie's water-repellent exterior shields you
                                                from
                                                the
                                                elements, while advanced fabric technology inside wicks moisture to
                                                keep
                                                you
                                                dry.</p>

                                            <ul>
                                                <li>Adipisicing elitEnim, laborum.</li>
                                                <li>Lorem ipsum dolor sit</li>
                                                <li>Dolorem molestiae quod voluptatem! Sint.</li>
                                                <li>Iure obcaecati odio pariatur quae saepe!</li>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="reviews">
                                            <div class="row">
                                                <div class="col-lg-7">
                                                    <div class="product-ratting-wrap">
                                                        <div class="pro-avg-ratting">
                                                            <h4>4.5 <span>(Overall)</span></h4>
                                                            <span>Based on 9 Comments</span>
                                                        </div>
                                                        <div class="ratting-list">
                                                            <div class="sin-list float-left">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <span>(5)</span>
                                                            </div>
                                                            <div class="sin-list float-left">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <span>(3)</span>
                                                            </div>
                                                            <div class="sin-list float-left">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <span>(1)</span>
                                                            </div>
                                                            <div class="sin-list float-left">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <span>(0)</span>
                                                            </div>
                                                            <div class="sin-list float-left">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <span>(0)</span>
                                                            </div>
                                                        </div>
                                                        <div class="rattings-wrapper">

                                                            <div class="sin-rattings">
                                                                <div class="ratting-author">
                                                                    <h3>Cristopher Lee</h3>
                                                                    <div class="ratting-star">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <span>(5)</span>
                                                                    </div>
                                                                </div>
                                                                <p>enim ipsam voluptatem quia voluptas sit
                                                                    aspernatur
                                                                    aut
                                                                    odit aut fugit, sed quia res eos qui ratione
                                                                    voluptatem
                                                                    sequi Neque porro quisquam est, qui dolorem
                                                                    ipsum
                                                                    quia
                                                                    dolor sit amet, consectetur, adipisci veli</p>
                                                            </div>

                                                            <div class="sin-rattings">
                                                                <div class="ratting-author">
                                                                    <h3>Nirob Khan</h3>
                                                                    <div class="ratting-star">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <span>(5)</span>
                                                                    </div>
                                                                </div>
                                                                <p>enim ipsam voluptatem quia voluptas sit
                                                                    aspernatur
                                                                    aut
                                                                    odit aut fugit, sed quia res eos qui ratione
                                                                    voluptatem
                                                                    sequi Neque porro quisquam est, qui dolorem
                                                                    ipsum
                                                                    quia
                                                                    dolor sit amet, consectetur, adipisci veli</p>
                                                            </div>

                                                            <div class="sin-rattings">
                                                                <div class="ratting-author">
                                                                    <h3>MD.ZENAUL ISLAM</h3>
                                                                    <div class="ratting-star">
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <span>(5)</span>
                                                                    </div>
                                                                </div>
                                                                <p>enim ipsam voluptatem quia voluptas sit
                                                                    aspernatur
                                                                    aut
                                                                    odit aut fugit, sed quia res eos qui ratione
                                                                    voluptatem
                                                                    sequi Neque porro quisquam est, qui dolorem
                                                                    ipsum
                                                                    quia
                                                                    dolor sit amet, consectetur, adipisci veli</p>
                                                            </div>

                                                        </div>
                                                        <div class="ratting-form-wrapper fix">
                                                            <h3>Add your Comments</h3>
                                                            <form action="#" method="post">
                                                                <div class="ratting-form row">
                                                                    <div class="col-12 mb-4">
                                                                        <h5>Rating:</h5>
                                                                        <div class="ratting-star fix">
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                            <i class="fa fa-star-o"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12 mb-4">
                                                                        <label for="name">Name:</label>
                                                                        <input id="name" placeholder="Name" type="text">
                                                                    </div>
                                                                    <div class="col-md-6 col-12 mb-4">
                                                                        <label for="email">Email:</label>
                                                                        <input id="email" placeholder="Email"
                                                                            type="text">
                                                                    </div>
                                                                    <div class="col-12 mb-4">
                                                                        <label for="your-review">Your
                                                                            Review:</label>
                                                                        <textarea name="review" id="your-review"
                                                                            placeholder="Write a review"></textarea>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <input value="add review" type="submit">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    $(document).ready(function() {
        $(".product-thumb-carousel").owlCarousel({
            loop: true, // التكرار التلقائي للسلايدر
            margin: 10, // المسافة بين العناصر
            nav: true, // إظهار الأسهم
            dots: true, // إظهار النقاط
            responsive: {
                0: {
                    items: 1
                }, // شاشة صغيرة: عنصر واحد
                600: {
                    items: 2
                }, // شاشة متوسطة: عنصران
                1000: {
                    items: 3
                } // شاشة كبيرة: ثلاثة عناصر
            }
        });
    });
    </script>
    @endsection