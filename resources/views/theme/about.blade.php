@extends('theme.master')
@section('title','About us')
@section('content')

<!--== About Us Area Start ==-->
<section id="aboutUs-area" class="pt-9">
    <div class="handeva-container">
        <div class="row her">
            <div class="col-lg-4 col-md-12">
                <!-- About Video Area Start -->
                <video muted autoplay class="video-fluid w-75"
                    style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);" id="customVideo">
                    <source src="{{ asset('videoes/48dff8a26c91b2b58797b977d7e7f824.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <!-- About Video Area End -->
            </div>
            <div class="col-lg-6 col-md-12 m-auto">
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

                        <a href="{{ route('collections') }}" class="btn btn-long-arrow">Explore All Products</a>
                    </div>
                    <h4 class="vertical-text">WHO WE ARE?</h4>
                </div>
                <!-- About Text Area End -->
            </div>
        </div>
    </div>
</section>
<!--== About Us Area End ==-->


@endsection