@extends('theme.master')
@section('title','Dashboard')
@section('content')

@include('theme.partials.hero',['title' => 'Vendor Dashboard'])

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="list-group">
                <a href="#account" class="list-group-item list-group-item-action" data-toggle="collapse">Account
                    Details</a>
                <a href="#upload-product" class="list-group-item list-group-item-action" data-toggle="collapse">Upload
                    Product</a>
                <a href="#view-products" class="list-group-item list-group-item-action" data-toggle="collapse">View
                    Products</a>
                <a href="#reviews" class="list-group-item list-group-item-action" data-toggle="collapse">View
                    Reviews</a>
                <a href="#customization-orders" class="list-group-item list-group-item-action"
                    data-toggle="collapse">Customization Orders</a>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Sections -->
            <div id="account" class="collapse">
                @include('theme.vendor.sections.account_details', ['vendor' => $vendor])
            </div>
            <div id="upload-product" class="collapse">
                @include('theme.vendor.sections.upload_product')
            </div>
            <div id="view-products" class="collapse">
                @include('theme.vendor.sections.view_products')
            </div>
            <div id="reviews" class="collapse">
                @include('theme.vendor.sections.reviews')
            </div>
            <div id="customization-orders" class="collapse">
                @include('theme.vendor.sections.customization_orders')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    // تأكد من أن القائمة تكون مفتوحة فقط عند النقر عليها
    $('#sidebar a').on('click', function() {
        var target = $(this).attr('href');
        $(target).collapse('toggle');
    });
});
</script>
@endpush