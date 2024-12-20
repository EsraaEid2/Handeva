@extends('theme.master')
@section('title','Wishlist')
@section('content')

@include('theme.partials.hero',['title' => 'Wishlist'])

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <!-- Wishlist Page Content Start -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Wishlist Table Area -->
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Stock Status</th>
                                <th class="pro-subtotal">Add to Cart</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wishlistItems as $item)
                            <tr>
                                <!-- Product Thumbnail -->
                                <td class="pro-thumbnail">
                                    <a href="#">
                                        <img class="img-fluid"
                                            src="{{ asset($item->product->primaryImage->image_url ?? 'default_image.jpg') }}"
                                            alt="{{ $item->product->title }}" />
                                    </a>
                                </td>

                                <!-- Product Title -->
                                <td class="pro-title">
                                    <a href="#">{{ $item->product->title }}</a>
                                </td>

                                <!-- Product Price -->
                                <td class="pro-price">
                                    <span>JOD {{ number_format($item->product->price, 2) }}</span>
                                </td>

                                <!-- Product Stock Status -->
                                <td class="pro-quantity">
                                    @if ($item->product->stock_quantity > 0)
                                    <span class="text-success">In Stock</span>
                                    @else
                                    <span class="text-danger">Out of Stock</span>
                                    @endif
                                </td>

                                <!-- Add to Cart Button -->
                                <td class="pro-subtotal">
                                    @if ($item->product->stock_quantity > 0)
                                    <a href="{{ route('cart.add', $item->product->id) }}" class="btn-add-to-cart"
                                        data-id="{{ $item->product->id }}">Add to Cart</a>
                                    @else
                                    <button class="btn-add-to-cart disabled" disabled>Out of Stock</button>
                                    @endif
                                </td>

                                <!-- Remove from Wishlist Button -->
                                <td class="pro-remove">
                                    <a href="{{ route('wishlist.remove', $item->id) }}" class="btn-remove-wishlist"
                                        data-id="{{ $item->id }}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Your wishlist is empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <!-- Wishlist Page Content End -->
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection