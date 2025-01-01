@extends('theme.master')
@section('title','Cart')
@section('content')

<!-- @include('theme.partials.hero',['title' => 'Shopping Cart']) -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="elegant-cart-wrapper">
    <div class="container-fluid">
        <div class="cart-content">
            <div class="cart-items-section">
                <h2 class="cart-heading">Your Selected Items</h2>
                <div class="cart-items">
                    @foreach($cartItems as $item)
                    <div class="cart-item" data-product-id="{{ $item['product_id'] }}">
                        <div class="item-image">
                            <img src="{{ asset($item['image_url']) }}" alt="{{ $item['title'] }}">
                        </div>
                        <div class="item-details">
                            <h3 class="item-name">{{ $item['title'] }}</h3>
                        </div>
                        <div class="item-quantity">
                            <button class="quantity-btn decrease">−</button>
                            <input type="number" value="{{ $item['quantity'] }}" min="1"
                                max="{{ $item['stock_quantity'] }}" class="quantity-input">
                            <button class="quantity-btn increase">+</button>
                        </div>
                        <div class="item-price">
                            <p class="current-price">JOD
                                {{ number_format($item['price_after_discount'] ?? $item['price'], 2) }}
                            </p>
                            <p class="total-item-price">JOD {{ number_format($item['total_price'], 2) }}</p>
                        </div>
                        <td>
                            <button class="remove-item" data-product-id="{{ $item['product_id'] }}">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="cart-summary">
                <div class="summary-content">
                    <h2 class="summary-heading">Order Summary</h2>
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal" class="amount">JOD {{ number_format($totalPrice, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span id="shipping" class="amount">JOD {{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="total" class="amount">JOD {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="checkout-button">Proceed to Checkout</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection