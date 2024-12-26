<style>
.owl-carousel .owl-nav button.owl-prev,
.owl-carousel .owl-nav button.owl-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
}

.owl-carousel .owl-nav button.owl-prev {
    left: 0;
}

.owl-carousel .owl-nav button.owl-next {
    right: 0;
}
</style>

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
                                        <a href="single-product.html"><img class="img-fluid"
                                                src="{{ asset($image->image_url) }}" alt="Product Image" /></a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->


                        <!-- Product Details Start -->
                        <div class="col-lg-7 mt-5 mt-lg-0">
                            <div class="product-details">
                                <!-- Product Title -->
                                <h2>{{ $product->title }}</h2>

                                <!-- Rating -->
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

                                <!-- Price -->
                                <span class="price">
                                    @if($product->price_after_discount)
                                    <del>JOD {{ $product->price }}</del>
                                    <span class="text-danger">JOD {{ $product->price_after_discount }}</span>
                                    @else
                                    JOD {{ $product->price }}
                                    @endif
                                </span>

                                <!-- Stock Status -->
                                <div class="product-info-stock-sku">
                                    <span
                                        class="product-stock-status {{ $product->stock_quantity > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="products-desc">{{ $product->description }}</p>

                                <!-- Traditional Product -->
                                @if($product->is_traditional)
                                <p><strong>Type:</strong> Traditional Accessory</p>
                                @endif
                                @if($product ->is_customizable)
                                <h4>Customization</h4>
                                <p><strong>Type:</strong> {{ $product->productCustomization->custom_type }}</p>
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

                                <!-- Quantity and Buttons -->
                                <div class="product-quantity d-flex align-items-center mt-4">
                                    <div class="quantity-field mr-3">
                                        <label for="qty">Quantity</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary btn-quantity-decrease">-</button>
                                            <input type="number" id="qty" min="1" max="{{ $product->stock_quantity }}"
                                                value="1" />
                                            <button class="btn btn-outline-secondary btn-quantity-increase">+</button>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-add-to-cart">Add to Cart</button>
                                </div>

                                <div class="product-btn-group mt-3">
                                    <button class="btn btn-outline-secondary btn-wishlist"><i class="fa fa-heart"></i>
                                        Add to Wishlist</button>
                                    <button class="btn btn-outline-secondary btn-compare"><i class="fa fa-exchange"></i>
                                        Add to Compare</button>
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
                                        <p>Stay comfortable and stay in the race no matter what the weather's up to.
                                            The
                                            Bruno Compete Hoodie's water-repellent exterior shields you from the
                                            elements, while advanced fabric technology inside wicks moisture to keep
                                            you
                                            dry.Stay comfortable and stay in the race no matter what the weather's
                                            up
                                            to. The Bruno Compete Hoodie's water-repellent exterior shields you from
                                            the
                                            elements, while advanced fabric technology inside wicks moisture to keep
                                            you
                                            dry.Stay comfortable and stay in the race no matter what the weather's
                                            up
                                            to. The Bruno Compete Hoodie's water-repellent exterior shields you from
                                            the
                                            elements, while advanced fabric technology inside wicks moisture to keep
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
                                                            <p>enim ipsam voluptatem quia voluptas sit aspernatur
                                                                aut
                                                                odit aut fugit, sed quia res eos qui ratione
                                                                voluptatem
                                                                sequi Neque porro quisquam est, qui dolorem ipsum
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
                                                            <p>enim ipsam voluptatem quia voluptas sit aspernatur
                                                                aut
                                                                odit aut fugit, sed quia res eos qui ratione
                                                                voluptatem
                                                                sequi Neque porro quisquam est, qui dolorem ipsum
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
                                                            <p>enim ipsam voluptatem quia voluptas sit aspernatur
                                                                aut
                                                                odit aut fugit, sed quia res eos qui ratione
                                                                voluptatem
                                                                sequi Neque porro quisquam est, qui dolorem ipsum
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
                                                                    <input id="email" placeholder="Email" type="text">
                                                                </div>
                                                                <div class="col-12 mb-4">
                                                                    <label for="your-review">Your Review:</label>
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