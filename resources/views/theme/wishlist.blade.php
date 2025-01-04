@extends('theme.master')
@section('title','Wishlist')
@section('content')

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="ep-wishlist-page p-9">
    <div class="container">
        <!-- Wishlist Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Wishlist Table Area -->
                <div class="ep-cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="ep-pro-thumbnail">Thumbnail</th>
                                <th class="ep-pro-title">Product</th>
                                <th class="ep-pro-price">Price</th>
                                <th class="ep-pro-subtotal">Add to Cart</th>
                                <th class="ep-pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wishlistItems as $item)
                            <tr>
                                <!-- Product Thumbnail -->
                                <td class="ep-pro-thumbnail">
                                    <a href="{{ route('product.showProductDetails', $item->id) }}">
                                        <img class="img-fluid" src="{{ asset($item->primary_image) }}"
                                            alt="{{ $item->title }}" />
                                    </a>
                                </td>
                                <!-- Product Title -->
                                <td class="ep-pro-title">
                                    <a
                                        href="{{ route('product.showProductDetails', $item->id) }}">{{ $item->title }}</a>
                                </td>
                                <!-- Product Price -->
                                <td class="ep-pro-price">
                                    <span>
                                        @if ($item->price_after_discount)
                                        JOD {{ $item->price_after_discount }}
                                        @else
                                        JOD {{ $item->price }}
                                        @endif
                                    </span>
                                </td>

                                <!-- Add to Cart Button -->
                                <td class="ep-pro-subtotal">
                                    <button class="ep-add-to-cart" data-product-id="{{ $item->id }}">
                                        <i class="fa fa-shopping-bag"></i> Add to Cart
                                    </button>
                                </td>

                                <!-- Remove from Wishlist Button -->
                                <td class="ep-pro-remove">
                                    <button class="ep-btn ep-btn-remove-wishlist remove-from-wishlist"
                                        data-product-id="{{ $item->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>

                            </tr>
                            @empty
                            <!-- If the wishlist is empty -->
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="empty-wishlist-message" style="text-align: center; padding: 2rem;">
                                        <img src="{{ asset('assets') }}/img/favicon.png" alt="Logo"
                                            style="width: 100px; margin-bottom: 1rem;">
                                        <h2
                                            style="font-family: var(--font-family-primary); font-size: var(--font-size-large); color: var(--primary-color);">
                                            Your wishlist is empty!
                                        </h2>
                                        <p
                                            style="font-family: var(--font-family-body); font-size: var(--font-size-regular); color: var(--dark-color);">
                                            Looks like you haven't added any products to your wishlist yet. Start
                                            exploring our shop and find your favorites!
                                        </p>
                                        <a href="{{ route('collections') }}" class="btn-explore-shop"
                                            style="font-family: var(--font-family-body); font-size: var(--font-size-regular); color: var(--secondary-color); background-color: var(--primary-color); padding: 0.75rem 1.5rem; border: none; border-radius: 5px; text-decoration: none;">
                                            Explore Products
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links --> @if ($wishlistItems instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="pagination"> {{ $wishlistItems->links() }} </div> @endif
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection