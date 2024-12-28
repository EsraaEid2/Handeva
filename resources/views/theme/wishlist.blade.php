@extends('theme.master')
@section('title','Wishlist')
@section('content')

@include('theme.partials.hero',['title' => 'Wishlist'])

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
                                    <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="ep-btn ep-add-to-cart"> <i
                                                class="fa fa-shopping-cart"></i>Add to Cart</button>
                                    </form>
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
                                <td colspan="5" class="text-center">Your wishlist is empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="pagination">
                    {{ $wishlistItems->links() }}
                </div>
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection