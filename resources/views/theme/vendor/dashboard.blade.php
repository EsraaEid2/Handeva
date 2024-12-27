@extends('theme.master')
@section('title', 'Vendor Dashboard')
@section('content')

@include('theme.partials.hero', ['title' => 'Vendor Dashboard'])

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Vendor Dashboard Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- Vendor Dashboard Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user-circle"></i> Account
                                    Details</a>
                                <a href="#upload-product" class="active" data-toggle="tab"><i class="fa fa-upload"></i>
                                    Upload Product</a>
                                <a href="#view-products" data-toggle="tab"><i class="fa fa-eye"></i> View Products</a>
                                <a href="#view-reviews" data-toggle="tab"><i class="fa fa-star"></i> View Reviews</a>
                                <a href="#customization-orders" data-toggle="tab"><i class="fa fa-paint-brush"></i>
                                    Customization Orders</a>
                            </div>
                        </div>

                        <!-- Vendor Dashboard Tab Menu End -->

                        <!-- Vendor Dashboard Tab Content Start -->
                        <div class="col-lg-9 mt-5 mt-lg-0">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Account Details Tab -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    @include('theme.vendor.sections.account_details')
                                </div>

                                <!-- Upload Product Tab -->
                                <div class="tab-pane fade show active" id="upload-product" role="tabpanel">
                                    @include('theme.vendor.sections.upload_product')
                                </div>

                                <!-- View Products Tab -->
                                <div class="tab-pane fade" id="view-products" role="tabpanel">
                                    @include('theme.vendor.sections.view_products')
                                </div>

                                <!-- View Reviews Tab -->
                                <div class="tab-pane fade" id="view-reviews" role="tabpanel">
                                    @include('theme.vendor.sections.view_reviews')
                                </div>

                                <!-- Customization Orders Tab -->
                                <div class="tab-pane fade" id="customization-orders" role="tabpanel">
                                    @include('theme.vendor.sections.customization_orders')
                                </div>
                            </div>
                        </div>
                        <!-- Vendor Dashboard Tab Content End -->
                    </div>
                </div>
                <!-- Vendor Dashboard Page End -->
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection