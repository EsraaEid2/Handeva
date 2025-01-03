@extends('theme.master')
@section('title','Contact Us')
@section('content')

<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <!-- Contact Form Start -->
            <div class="col-lg-9 m-auto">
                <div class="contact-form-wrap">
                    <h2>Request a Quote</h2>
                    <form id="contact-form" action="{{ route('contact.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-input-item">
                                    <input type="text" name="first_name" placeholder="First Name *" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="single-input-item">
                                    <input type="text" name="last_name" placeholder="Last Name *" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single-input-item">
                                    <input type="email" name="email_address" placeholder="Email Address *" required />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="single-input-item">
                                    <input type="text" name="contact_subject" placeholder="Subject *" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="single-input-item">
                                    <textarea name="message" id="message" cols="30" rows="6" placeholder="Message"
                                        required></textarea>
                                </div>

                                <div class="single-input-item text-center">
                                    <button type="submit" name="submit" class="btn-add-to-cart">Send Message</button>
                                </div>

                                <!-- Form Notification -->
                                @if(session('success'))
                                <div class="form-message">{{ session('success') }}</div>
                                @endif
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <!-- Contact Form End -->
        </div>
        <div class="row">
            <!-- Contact Page Content Start -->
            <div class="col-lg-12">
                <!-- Contact Method Start -->
                <div class="contact-method-wrap">
                    <div class="row">
                        <!-- Single Method Start -->
                        <div class="col-lg-3 col-sm-6 text-center">
                            <div class="contact-method-item">
                                <span class="method-icon"><i class="fa fa-map-marker"></i></span>
                                <div class="method-info">
                                    <h3>Street Address</h3>
                                    <p>Address : Nairobi 3232 <br> Nairobi, Kenya</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Method End -->

                        <!-- Single Method Start -->
                        <div class="col-lg-3 col-sm-6 text-center">
                            <div class="contact-method-item">
                                <span class="method-icon"><i class="fa fa-phone"></i></span>
                                <div class="method-info">
                                    <h3>Phone Number</h3>
                                    <a href="tel:0(1234)56789012">0(1234) 567 89012</a>
                                    <a href="tel:0(1234)56789012">0(1323) 466 89012</a>
                                </div>
                            </div>
                        </div>

                        <!-- Single Method Start -->
                        <div class="col-lg-3 col-sm-6 text-center">
                            <div class="contact-method-item">
                                <span class="method-icon"><i class="fa fa-envelope"></i></span>
                                <div class="method-info">
                                    <h3>Email Address</h3>
                                    <a href="mailto:your@email.here">your@email.here</a>
                                    <a href="mailto:your@email.here">your@email.here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Method End -->
                    </div>
                </div>
                <!-- Contact Method End -->
            </div>
            <!-- Contact Page Content End -->
        </div>


    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection