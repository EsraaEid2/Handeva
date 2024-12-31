    @extends('theme.master')
    @section('title','Home')
    @section('home-active','active')

    @section('content')
    @include('theme.partials.banner')
    @include('theme.partials.new_products')
    @include('theme.partials.product_categories')
    @include('theme.partials.vendor_section')
    @include('theme.partials.bazaar')
    @include('theme.partials.features')

    <!--== Newsletter Area Start ==-->
    <section id="newsletter-area" class="p-9">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2>Join The Newsletter</h2>
                        <p>Sign Up for Our Newsletter</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="newsletter-form-wrap">
                        <form id="subscribe-form"
                            action="https://d29u17ylf1ylz9.cloudfront.net/ruby-v2/ruby/assets/php/subscribe.php"
                            method="post">
                            <input id="subscribe" type="email" name="email" placeholder="Enter your Email  Here"
                                required />
                            <button type="submit" class="btn-long-arrow">Subscribe</button>
                            <div id="result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Newsletter Area End ==-->
    @if(session('status') === 'pending_vendor')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Thank you for registering as a vendor!',
        text: 'Your request is under review. We will contact you soon. Stay tuned and get ready to join our amazing marketplace!',
        confirmButtonText: 'OK',
    });
});
    </script>
    @endif


    @endsection