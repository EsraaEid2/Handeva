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
                        <div class="vendor-details">
                            <h3 class="vendor-name">
                                <a
                                    href="{{ route('vendor.dashboard', $vendor->vendor_id) }}">{{ $vendor->vendor_name }}</a>
                                <span class="top-seller-icon" title="Top Seller">&#9733;</span>
                                <!-- Star icon for top seller -->
                            </h3>
                            <p class="vendor-sales">
                                <span class="icon-upload">&#128228;</span> <!-- Upload icon -->
                                Products Uploaded: {{ $vendor->total_uploaded_products }}<br>
                                <span class="icon-sold">&#128176;</span> <!-- Money bag icon -->
                                Products Sold: {{ $vendor->total_sold_products }}
                            </p>
                            <p class="vendor-quote">
                                "Keep creating, keep shining!"
                            </p>
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