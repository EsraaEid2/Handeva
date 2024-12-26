<!--== Top Vendors Area Start ==-->
<section id="top-vendors-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h2
                        style="font-family: var(--font-family-primary); font-size: var(--font-size-large); color: var(--dark-color);">
                        Top Vendors
                    </h2>
                    <p
                        style="font-family: var(--font-family-body); font-size: var(--font-size-regular); color: var(--neutral-color);">
                        Meet our top vendors based on their sales performance.
                    </p>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="vendors-content-wrap">
            <div class="row">
                @foreach ($topVendors as $vendor)
                <div class="col-lg-4 col-md-6">
                    <!-- Single Vendor Item Start -->
                    <div class="single-vendor-wrap">
                        <div class="vendor-thumb">
                            <a href="{{ route('vendor.dashboard', $vendor->vendor_id) }}">
                                <img src="{{ asset('assets/img/vendor-placeholder.jpg') }}"
                                    alt="{{ $vendor->vendor_name }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="vendor-details">
                            <h3 style="font-family: var(--font-family-secondary); color: var(--dark-color);">
                                <a
                                    href="{{ route('vendor.dashboard', $vendor->vendor_id) }}">{{ $vendor->vendor_name }}</a>
                            </h3>
                            <p class="vendor-sales" style="font-family: var(--font-family-body);">
                                Products Uploaded: {{ $vendor->total_uploaded_products }}<br>
                                Products Sold: {{ $vendor->total_sold_products }}
                            </p>
                            <p style="font-family: var(--font-family-body); color: var(--neutral-color);">
                                {{ $vendor->bio }}
                            </p>
                            <a href="{{ route('vendor.dashboard', $vendor->vendor_id) }}" class="btn-long-arrow">
                                View Profile
                            </a>
                        </div>
                    </div>
                    <!-- Single Vendor Item End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--== Top Vendors Area End ==-->