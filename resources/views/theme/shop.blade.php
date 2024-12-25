@extends('theme.master')
@section('title','Shop')
@section('content')

@include('theme.partials.hero',['title' => 'Shop'])

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="col-lg-3 mt-5 mt-lg-0 order-last order-lg-first">
                <div id="sidebar-area-wrap">
                    <!-- Single Sidebar Item: Categories -->
                    <div class="single-sidebar-wrap">
                        <h2 class="sidebar-title">Categories</h2>
                        <ul class="sidebar-list">
                            <!-- Categories -->
                            @foreach($categories as $category)
                            <li>
                                <a
                                    href="{{ route('collections', array_merge(request()->all(), ['category_id' => $category->id])) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Single Sidebar Item: Product Types -->
                    <div class="single-sidebar-wrap">
                        <h2 class="sidebar-title">Product Type</h2>
                        <ul class="sidebar-list">
                            <!-- Product Types -->
                            <li><a
                                    href="{{ route('collections', array_merge(request()->all(), ['type' => 'custom'])) }}">Custom
                                    Products</a></li>
                            <li><a
                                    href="{{ route('collections', array_merge(request()->all(), ['type' => 'traditional'])) }}">Traditional</a>
                            </li>
                            <li><a href="{{ route('collections', array_merge(request()->all(), ['type' => 'sale'])) }}">On
                                    Sale</a></li>
                        </ul>
                    </div>

                    <!-- Single Sidebar Item: Price Filter -->
                    <div class="single-sidebar-wrap">
                        <h2 class="sidebar-title">Price Range</h2>
                        <ul class="sidebar-list">
                            <!-- Price Range -->
                            @foreach($priceRanges as $range)
                            <li>
                                <a
                                    href="{{ route('collections', array_merge(request()->all(), ['min_price' => $range['min'], 'max_price' => $range['max']])) }}">
                                    ${{ number_format($range['min'], 2) }} - ${{ number_format($range['max'], 2) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Reset Button -->
                    <div class="single-sidebar-wrap text-center mt-3">
                        <a href="{{ route('collections') }}" class="btn btn-secondary">Reset Filters</a>

                    </div>
                </div>
            </div>
            <!-- Sidebar Area End -->

            <!-- Products Area Start -->
            <div class="col-lg-9">
                <div class="shop-page-content-wrap">
                    <!-- Product Sort Options -->
                    <div class="products-settings-option d-flex justify-content-between">
                        <div class="product-cong-left d-flex align-items-center">
                            <ul class="product-view d-flex align-items-center">
                                <li class="current column-gird"><i class="fa fa-bars fa-rotate-90"></i></li>
                                <li class="box-gird"><i class="fa fa-th"></i></li>
                                <li class="list"><i class="fa fa-list-ul"></i></li>
                            </ul>
                            <span class="show-items">Items 1 - 9 of 17</span>
                        </div>
                        <form method="GET" id="sortForm">
                            <label for="sort">Sort By:</label>
                            <select name="sort" id="sort" onchange="this.form.submit();">
                                <option value="relevance">Relevance</option>
                                <option value="name_asc">Name, A to Z</option>
                                <option value="name_desc">Name, Z to A</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                            </select>
                        </form>
                    </div>

                    <!-- Products Grid -->
                    <div class="shop-page-products-wrap">
                        <div class="products-wrapper">
                            <div class="row">
                                @foreach($products as $product)
                                @if($product->is_visible)
                                <div class="col-lg-4 col-sm-6">
                                    <!-- Single Product Item -->
                                    <div class="single-product-item text-center">
                                        <figure class="product-thumb">
                                            <a href="{{ route('product.showProductDetails', $product->id) }}">
                                                <img src="{{ $product->primaryImage?->image_url ?? 'default-image.jpg' }}"
                                                    alt="{{ $product->title }}">
                                            </a>
                                        </figure>


                                        <div class="product-details">
                                            <h2>
                                                <a
                                                    href="{{ route('product.showProductDetails', $product->id) }}">{{ $product->title }}</a>
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
                                            <a href="{{ route('cart.add', $product->id) }}"
                                                class="btn btn-add-to-cart">+ Add to Cart</a>
                                            @else
                                            <span class="text-danger">Out of Stock</span>
                                            @endif

                                            <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-add-to-cart btn-whislist">+
                                                    Wishlist</button>
                                            </form>


                                            <a href="#" class="btn btn-add-to-cart btn-compare">+ Compare</a>
                                        </div>


                                        <div class="product-meta">

                                            <button type="button" data-toggle="modal" data-target="#quickView"
                                                data-id="{{ $product->id }}">
                                                <span data-toggle="tooltip" data-placement="left" title="Quick View">
                                                    <i class="fa fa-compress"></i>
                                                </span>
                                            </button>
                                            <a href="javascript:void(0);" onclick="addToWishlist({{ $product->id }})"
                                                data-toggle="tooltip" data-placement="left" title="Add to Wishlist">
                                                <i class="fa fa-heart-o"></i>
                                            </a>


                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Compare">
                                                <i class="fa fa-tags"></i>
                                            </a>
                                        </div>

                                        <!-- Conditional "New" Badge -->
                                        @if($product->created_at && $product->created_at->diffInDays(now()) <= 30) <span
                                            class="product-bedge">New</span>
                                            @endif

                                    </div>
                                    <!-- Single Product Item -->
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <nav class="page-pagination">
                        {{ $products->appends(request()->input())->links() }}
                    </nav>
                </div>
            </div>
            <!-- Products Area End -->
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->


<!-- Start All Modal Content -->
<!--== Product Quick View Modal Area Wrap ==-->
<div class="modal fade" id="quickView" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/img/cancel.png') }}" alt="Close"
                        class="img-fluid" /></span>
            </button>
            <div class="modal-body">
                <div class="quick-view-content single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5 col-md-6">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel" id="quickViewImages">
                                    <!-- Images will be appended dynamically -->
                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                            <div class="product-details">
                                <h2 id="quickViewTitle"></h2>
                                <div id="quickViewRating" class="rating">
                                    <!-- Ratings will be dynamically added -->
                                </div>
                                <span id="quickViewPrice" class="price"></span>
                                <div class="product-info-stock-sku">
                                    <span id="quickViewStock" class="product-stock-status"></span>
                                    <span id="quickViewSku" class="product-sku-status ml-5"></span>
                                </div>
                                <p id="quickViewDescription" class="products-desc"></p>
                                <div id="quickViewColors" class="shopping-option-item"></div>
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" min="1" max="100" value="1" />
                                    </div>
                                    <button id="quickViewAddToCart" class="btn btn-add-to-cart">Add to Cart</button>
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

<!--== Product Quick View Modal Area End ==-->
<!-- End All Modal Content -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const quickViewModal = document.getElementById('quickView');

    document.querySelectorAll('.btn-quick-view').forEach((button) => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');

            // Fetch product details via AJAX
            fetch(`/product/${productId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate modal content
                    document.getElementById('quickViewTitle').innerText = data.title;
                    document.getElementById('quickViewPrice').innerHTML = data
                        .price_after_discount ?
                        `<del>${data.price}</del> ${data.price_after_discount}` :
                        data.price;
                    document.getElementById('quickViewStock').innerText = data
                        .stock_quantity > 0 ? 'In Stock' : 'Out of Stock';
                    document.getElementById('quickViewSku').innerText = `SKU: ${data.sku}`;
                    document.getElementById('quickViewDescription').innerText = data
                        .description;

                    // Populate images
                    const imagesContainer = document.getElementById('quickViewImages');
                    imagesContainer.innerHTML = ''; // Clear previous images
                    data.images.forEach(image => {
                        const imgElement = document.createElement('div');
                        imgElement.className = 'single-thumb-item';
                        imgElement.innerHTML =
                            `<img src="${image.url}" class="img-fluid" alt="Product Image">`;
                        imagesContainer.appendChild(imgElement);
                    });

                    // Populate colors
                    const colorsContainer = document.getElementById('quickViewColors');
                    colorsContainer.innerHTML = `<h4>Color</h4>`;
                    const colorList = document.createElement('ul');
                    colorList.className = 'color-option-select d-flex';
                    data.colors.forEach(color => {
                        const colorItem = document.createElement('li');
                        colorItem.className = `color-item ${color.toLowerCase()}`;
                        colorItem.innerHTML = `<div class="color-hvr">
                            <span class="color-fill"></span>
                            <span class="color-name">${color}</span>
                        </div>`;
                        colorList.appendChild(colorItem);
                    });
                    colorsContainer.appendChild(colorList);

                    // Add to cart button
                    const addToCartButton = document.getElementById('quickViewAddToCart');
                    addToCartButton.setAttribute('data-id', data.id);
                })
                .catch(err => console.error(err));
        });
    });
});
</script>
@endsection