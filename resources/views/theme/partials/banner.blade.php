<!--== Banner // Slider Area Start ==-->
<section id="banner-area">
    <div class="handeva-container">
        <div class="row">
            <div class="col-lg-12">
                <div id="banner-carousel" class="owl-carousel">
                    <!-- Banner Single Carousel Start -->
                    <div id="accessoriesBanner" class="single-carousel-wrap ">
                        <div class="banner-caption text-lg-left">
                            <h4>Explore Our Store</h4>
                            <h2>Discover Unique Handmade Products</h2>
                            <p>Explore a world of creativity with our exclusive handmade collections. Perfect for any
                                occasion.</p>
                            <a href="{{ route('collections') }}" class="btn-long-arrow">Explore All Products</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->

                    <!-- Banner Single Carousel Start -->
                    <div id="vendorbanner" class="single-carousel-wrap slide-item-2">
                        <div class="banner-caption text-lg-left">
                            <h4>Join Us as a Vendor</h4>
                            <h2>Showcase Your Creativity</h2>
                            <p>Are you an artisan? Join our marketplace and share your handmade products with the world.
                            </p>
                            <a href="{{ route ('login_register')}}" class="btn-long-arrow">Become a Vendor</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->

                    <!-- Banner Single Carousel Start -->
                    <div id="tradtionalbanner" class="single-carousel-wrap slide-item-3">
                        <div class="banner-caption text-lg-left">
                            <h4>New Collections</h4>
                            <h2>Stunning Traditional Accessories</h2>
                            <p>Explore our exclusive collection of traditional Jordanian and Palestinian accessories.
                            </p>
                            <a href="{{ route('products.byCategory', ['id' => $category->id]) }}"
                                class="btn-long-arrow">Shop
                                Traditional</a>
                        </div>
                    </div>
                    <!-- Banner Single Carousel End -->
                </div>

            </div>
        </div>
    </div>
</section>
<!--== Banner Slider End ==-->