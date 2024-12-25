    @extends('theme.master')
    @section('title','Home')
    @section('home-active','active')

    @section('content')
    @include('theme.partials.banner')
    @include('theme.partials.about_us')
    @include('theme.partials.product_categories')
    @include('theme.partials.new_products')


    <!--== Testimonial Area Start ==-->
    <section id="testimonial-area">
        <div class="handeva-container">
            <div class="testimonial-wrapper">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2>What People Say</h2>
                            <p>Testimonials</p>
                        </div>
                        <!-- Section Title End -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7 m-auto text-center">
                        <div class="testimonial-content-wrap">
                            <div id="testimonialCarousel" class="owl-carousel">
                                <div class="single-testimonial-item">
                                    <p>These guys have been absolutely outstanding. When I needed them they came through
                                        in
                                        a big way! I know that if you buy this theme, you'll get the one thing we all
                                        look
                                        for when we buy on Themeforest, and that's real support for the craziest of
                                        requests!</p>

                                    <h3 class="client-name">Luis Manrata</h3>
                                    <span class="client-email">you@email.here</span>
                                </div>

                                <div class="single-testimonial-item">
                                    <p>These guys have been absolutely outstanding. When I needed them they came through
                                        in
                                        a big way! I know that if you buy this theme, you'll get the one thing we all
                                        look
                                        for when we buy on Themeforest, and that's real support for the craziest of
                                        requests!</p>

                                    <h3 class="client-name">John Dibba</h3>
                                    <span class="client-email">you@email.here</span>
                                </div>

                                <div class="single-testimonial-item">
                                    <p>These guys have been absolutely outstanding. When I needed them they came through
                                        in
                                        a big way! I know that if you buy this theme, you'll get the one thing we all
                                        look
                                        for when we buy on Themeforest, and that's real support for the craziest of
                                        requests!</p>

                                    <h3 class="client-name">Alex Tuntuni</h3>
                                    <span class="client-email">you@email.here</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Testimonial Area End ==-->

    <!--== Blog Area Start ==-->
    <section id="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2>From Our Blog</h2>
                        <p>Share your latest posts or best articles will post here.</p>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="blog-content-wrap">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <!-- Single Blog Item Start -->
                        <div class="single-blog-wrap">
                            <figure class="blog-thumb">
                                <a href="single-blog.html"><img src="{{ asset('assets') }}/img/blog-thumb.jpg"
                                        alt="blog" class="img-fluid" /></a>
                                <figcaption class="blog-icon">
                                    <a href="single-blog.html"><i class="fa fa-file-image-o"></i></a>
                                </figcaption>
                            </figure>

                            <div class="blog-details">
                                <h3><a href="single-blog.html">Mirum est notare quam</a></h3>
                                <span class="post-date">20/June/2018</span>
                                <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit
                                    litterarum.</p>
                                <a href="single-blog.html" class="btn-long-arrow">Read More</a>
                            </div>
                        </div>
                        <!-- Single Blog Item End -->
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <!-- Single Blog Item Start -->
                        <div class="single-blog-wrap">
                            <figure class="blog-thumb">
                                <a href="single-blog.html"><img src="{{ asset('assets') }}/img/blog-thumb-2.jpg"
                                        alt="blog" class="img-fluid" /></a>
                                <figcaption class="blog-icon">
                                    <a href="single-blog.html"><i class="fa fa-file-image-o"></i></a>
                                </figcaption>
                            </figure>

                            <div class="blog-details">
                                <h3><a href="single-blog.html">Mirum est notare quam</a></h3>
                                <span class="post-date">20/June/2018</span>
                                <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit
                                    litterarum.</p>
                                <a href="single-blog.html" class="btn-long-arrow">Read More</a>
                            </div>
                        </div>
                        <!-- Single Blog Item End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Single Blog Item Start -->
                        <div class="single-blog-wrap">
                            <figure class="blog-thumb">
                                <a href="single-blog.html"><img src="{{ asset('assets') }}/img/blog-thumb-3.jpg"
                                        alt="blog" class="img-fluid" /></a>
                                <figcaption class="blog-icon">
                                    <a href="single-blog.html"><i class="fa fa-file-image-o"></i></a>
                                </figcaption>
                            </figure>

                            <div class="blog-details">
                                <h3><a href="single-blog.html">Mirum est notare quam</a></h3>
                                <span class="post-date">20/June/2018</span>
                                <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit
                                    litterarum.</p>
                                <a href="single-blog.html" class="btn-long-arrow">Read More</a>
                            </div>
                        </div>
                        <!-- Single Blog Item End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Blog Area End ==-->

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
    @endsection