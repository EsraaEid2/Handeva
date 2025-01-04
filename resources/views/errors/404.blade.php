@extends('theme.master')

@section('title','404')

@section('content')
<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto text-center">
                <div class="custom-error-page-content-wrap">
                    <div class="custom-logo-wrap">
                        <img src=" {{ asset('assets') }}/img/favicon.png" alt="Website Logo" class="custom-logo">
                    </div>
                    <h2 class="custom-error-code">404</h2>
                    <h3 class="custom-error-message">PAGE NOT FOUND</h3>
                    <p class="custom-error-description">Sorry, but the page you are looking for does not exist, has been
                        removed, name changed, or is temporarily unavailable.</p>
                    <a href="{{ route('user.home') }}" class="custom-btn-back-home">Back to Home Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->
@endsection