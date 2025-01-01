@extends('theme.master')
@section('title', 'Checkout')
@section('content')

@include('theme.partials.hero', ['title' => 'Checkout'])

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <!-- Checkout Billing Details -->
            <div class="col-lg-6">
                <div class="checkout-billing-details-wrap">
                    <h2>Billing Details</h2>
                    <div class="billing-form-wrap">
                        <form id="checkout-form" method="POST" action="{{ route('checkout.process') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">First Name</label>
                                        <input type="text" id="f_name" name="first_name" value="{{ $user->first_name }}"
                                            placeholder="First Name" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="l_name" class="required">Last Name</label>
                                        <input type="text" id="l_name" name="last_name" value="{{ $user->last_name }}"
                                            placeholder="Last Name" required />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}"
                                    placeholder="Email Address" required />
                            </div>
                            <div class="single-input-item">
                                <label for="street-address" class="required">Street Address</label>
                                <input type="text" id="street-address" name="address" value="{{ $user->address }}"
                                    placeholder="Street Address Line 1" required />
                            </div>
                            <div class="single-input-item">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone_number" value="{{ $user->phone_number }}"
                                    placeholder="Phone" />
                            </div>
                            <div class="single-input-item">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" value="{{ $user->age }}" placeholder="Age" />
                            </div>

                            <!-- Payment Methods -->
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="payment_method" value="cash"
                                            class="custom-control-input" checked />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="stripepayment" name="payment_method" value="stripe"
                                            class="custom-control-input" />
                                        <label class="custom-control-label" for="stripepayment">Stripe</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Stripe Payment Section -->
                            <div id="stripe-card-section" style="display: none; margin-top: 20px;">
                                <h4>Pay with Card</h4>
                                <div id="card-element" class="my-3"></div>
                                <div id="card-errors" class="text-danger my-2"></div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Place Order</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="order-summary-details">
                    <h2>Your Order Summary</h2>
                    <div class="order-summary-content">
                        <div class="order-summary-table table-responsive text-center">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                    <tr>
                                        <td>{{ $item['title'] }} <strong> × {{ $item['quantity'] }}</strong></td>
                                        <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>${{ number_format($totalPrice, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stripeSection = document.getElementById('stripe-card-section');
    const paymentMethods = document.getElementsByName('payment_method');

    // Toggle Stripe card section visibility
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            stripeSection.style.display = (this.value === 'stripe') ? 'block' : 'none';
        });
    });

    // Stripe Initialization
    const stripe = Stripe("{{ env('STRIPE_PUBLIC_KEY') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', async function(e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'stripe') {
            e.preventDefault();
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                // Attach Payment Method ID to the form
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'payment_method_id';
                hiddenInput.value = paymentMethod.id;
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        }
    });
});
</script>
@endsection