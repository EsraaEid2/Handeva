    <!--== About Us Area Start ==-->
    <section id="aboutUs-area" class="pt-9">
        <div class="handeva-container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- About Image Area Start -->
                    <div class="about-image-wrap">
                        <img src="{{ asset('assets') }}/img/about-img.png" alt="About Us" class="img-fluid" />
                    </div>
                    <!-- About Image Area End -->
                </div>
                <div class="col-lg-6 m-auto">
                    <!-- About Text Area Start -->
                    <div class="about-content-wrap ml-0 ml-lg-5 mt-5 mt-lg-0">
                        <h2>About Us</h2>
                        <h3>Celebrating Artistry & Heritage</h3>
                        <div class="about-text">
                            <p>
                                At <strong>Handéva</strong>, we bring together tradition and innovation
                                to craft a unique marketplace for handmade accessories. Each product you find here
                                is a blend of artistry and personal touch, designed to tell a story and celebrate
                                individuality.
                            </p>

                            <p>
                                From customizable bracelets to timeless traditional necklaces, our collections
                                are crafted to inspire and delight. By supporting us, you empower artisans to
                                preserve their craft while creating meaningful pieces for you to cherish.
                            </p>

                            <a href="/about" class="btn btn-long-arrow">Learn More</a>
                        </div>
                        <h4 class="vertical-text">WHO WE ARE?</h4>
                    </div>
                    <!-- About Text Area End -->
                </div>
            </div>
        </div>
    </section>
    <!--== About Us Area End ==-->@include('theme.partials.about')@extends('theme.master')
@section('title','Contact Us')
@section('content')


<section id="about-us" style="padding: 50px; background-color: #f9f9f9; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.5em; margin-bottom: 20px;">About Handeva</h2>
        <p style="font-size: 1.2em; line-height: 1.8; margin-bottom: 40px; color: #555;">
            Welcome to <strong>Handeva</strong>, your ultimate online platform for unique handmade accessories.
            We empower talented vendors to showcase and manage their creations effortlessly. Vendors can upload, edit,
            or remove products, monitor customer reviews, and handle <em>customization orders</em> with ease. They can
            also update order statuses and manage their profiles seamlessly. Our platform includes a competitive edge
            with a <strong>Top Vendors</strong> section on the landing page, highlighting vendors based on the
            popularity of their products.
        </p>
        <p style="font-size: 1.2em; line-height: 1.8; margin-bottom: 40px; color: #555;">
            For customers, Handeva offers a delightful shopping experience. Explore a wide variety of products
            categorized for your convenience, filter by price, or choose between <em>customized</em> and
            <em>traditional</em> items. Add products to your wishlist or cart, place orders, and choose between cash or
            Stripe for payment. Stay on top of your orders, leave reviews to support your favorite vendors, and bring
            your accessory ideas to life with our customization feature.
        </p>
        <p style="font-size: 1.2em; line-height: 1.8; color: #555;">
            At Handeva, we’re committed to connecting customers with skilled artisans and fostering a community where
            creativity and craftsmanship shine. Join us today to celebrate the art of handmade accessories!
        </p>
    </div>

    <div style="margin-top: 50px;">
        <div
            style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; background: #000;">
            <iframe src="https://www.youtube.com/embed/your_video_id" title="Handeva Accessories Video" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
            </iframe>
        </div>
    </div>
</section>

@endsection