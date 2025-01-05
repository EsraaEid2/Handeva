@extends('theme.master')
@section('title','About us')
@section('content')

<!--== About Us Area Start ==-->
<section class="about-section pt-9">
    <div class="handeva-container" style="height:100vh;">
        <div class="about-grid">
            <!-- Video Column -->
            <div class="about-video-column">
                <div class="video-wrapper">
                    <video muted autoplay class="about-video" id="customVideo">
                        <source src="{{ asset('videoes/48dff8a26c91b2b58797b977d7e7f824.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <!-- Content Column -->
            <div class="about-content-column">
                <div class="about-content">
                    <h2 class="about-subtitle">About Us</h2>
                    <h3 class="about-title">Celebrating Artistry & Heritage</h3>

                    <div class="about-description">
                        <p class="about-paragraph">
                            At <span class="brand-name">Handéva</span>, we bring together tradition and innovation
                            to craft a unique marketplace for handmade accessories. Each product you find here
                            is a blend of artistry and personal touch, designed to tell a story and celebrate
                            individuality.
                        </p>

                        <p class="about-paragraph">
                            From customizable bracelets to timeless traditional necklaces, our collections
                            are crafted to inspire and delight. By supporting us, you empower artisans to
                            preserve their craft while creating meaningful pieces for you to cherish.
                        </p>

                        <a href="{{ route('collections') }}" class="btn-long-arrow">Explore All Products</a>
                    </div>

                    <div class="about-decoration">
                        <span class="vertical-text">WHO WE ARE?</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== About Us Area End ==-->

@endsection