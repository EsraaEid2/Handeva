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
                    <h2>Get in Touch</h2>
                    <p>Have a question or feedback? We'd love to hear from you. Fill out the form below and we'll get
                        back to you as
                        soon as possible.</p>
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
                @include('theme.partials.features')
            </div>
            <!-- Contact Page Content End -->
        </div>


    </div>
</div>
<!--== Page Content Wrapper End ==-->

@endsection