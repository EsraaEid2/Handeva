<!DOCTYPE html>
<html class="no-js" lang="zxx">

@include('theme.partials.head')

<body>
    @include('theme.partials.header')

    @yield('content')

    @include('theme.partials.footer')

    <!-- Start All Modal Content -->
    <!--== Product Quick View Modal Area Wrap ==-->
    <div class="modal fade" id="quickView" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets') }}/img/cancel.png" alt="Close"
                            class="img-fluid" /></span>
                </button>
                <div class="modal-body">
                    <div class="quick-view-content single-product-page-content">
                        <div class="row">
                            <!-- Product Thumbnail Start -->
                            <div class="col-lg-5 col-md-6">
                                <div class="product-thumbnail-wrap">
                                    <div class="product-thumb-carousel owl-carousel">
                                        <div class="single-thumb-item">
                                            <a href="single-product.html"><img class="img-fluid"
                                                    src="{{ asset('assets') }}/img/single-pro-thumb.jpg"
                                                    alt="Product" /></a>
                                        </div>

                                        <div class="single-thumb-item">
                                            <a href="single-product.html"><img class="img-fluid"
                                                    src="{{ asset('assets') }}/img/single-pro-thumb-2.jpg"
                                                    alt="Product" /></a>
                                        </div>

                                        <div class="single-thumb-item">
                                            <a href="single-product.html"><img class="img-fluid"
                                                    src="{{ asset('assets') }}/img/single-pro-thumb-3.jpg"
                                                    alt="Product" /></a>
                                        </div>

                                        <div class="single-thumb-item">
                                            <a href="single-product.html"><img class="img-fluid"
                                                    src="{{ asset('assets') }}/img/single-pro-thumb-4.jpg"
                                                    alt="Product" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Thumbnail End -->

                            <!-- Product Details Start -->
                            <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                                <div class="product-details">
                                    <h2><a href="single-product.html">Crown Summit Backpack</a></h2>

                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <span class="price">$52.00</span>

                                    <div class="product-info-stock-sku">
                                        <span class="product-stock-status">In Stock</span>
                                        <span class="product-sku-status ml-5"><strong>SKU</strong> MH03</span>
                                    </div>

                                    <p class="products-desc">Ideal for cold-weathered training worked lorem ipsum
                                        outdoors,
                                        the Chaz Hoodie promises superior warmth with every wear. Thick material blocks
                                        out
                                        the wind as ribbed cuffs and bottom band seal in body heat Lorem ipsum dolor sit
                                        amet, consectetur adipisicing elit. Enim, reprehenderit.</p>
                                    <div class="shopping-option-item">
                                        <h4>Color</h4>
                                        <ul class="color-option-select d-flex">
                                            <li class="color-item black">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">Black</span>
                                                </div>
                                            </li>

                                            <li class="color-item green">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">green</span>
                                                </div>
                                            </li>

                                            <li class="color-item orange">
                                                <div class="color-hvr">
                                                    <span class="color-fill"></span>
                                                    <span class="color-name">Orange</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="quantity-field">
                                            <label for="qty">Qty</label>
                                            <input type="number" id="qty" min="1" max="100" value="1" />
                                        </div>

                                        <a href="cart.html" class="btn btn-add-to-cart">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Details End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Product Quick View Modal Area End ==-->
    <!-- End All Modal Content -->

    @include('theme.partials.scripts')

</body>

</html>