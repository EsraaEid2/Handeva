@extends('theme.master')
@section('title','Member Area')
@section('content')


<!--== Page Content Wrapper Start ==-->
<div id="page-content-wrapper" class="p-9">
    <div class="container " style="height: 100vh;">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <!-- Login & Register Content Start -->
                <div class="handeva-auth">
                    <div class="login-register-wrapper">
                        <!-- Login & Register tab Menu -->
                        <nav class="nav login-reg-tab-menu">
                            <a class="active" id="login-tab" data-toggle="tab" href="#login">Login</a>
                            <a id="register-tab" data-toggle="tab" href="#register">Register</a>
                        </nav>

                        <div class="tab-content" id="login-reg-tabcontent">
                            <div class="tab-pane fade show active" id="login" role="tabpanel">
                                <div class="login-reg-form-wrap">
                                    <form action="{{route('checkLogin')}}" method="POST">
                                        @csrf
                                        <div class="single-input-item">
                                            <input type="email" name="email" placeholder="Enter your Email" required />
                                        </div>

                                        <div class="single-input-item">
                                            <input type="password" name="password" placeholder="Enter your Password"
                                                required />
                                        </div>

                                        <div class="single-input-item">
                                            <button class="btn-login">Login</button>
                                        </div>
                                        <a href="#register" class="auth-link" data-toggle="tab">Don't have an account?
                                            Register here</a>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="register" role="tabpanel">
                                <div class="login-reg-form-wrap">
                                    <form action="{{route('store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <input type="text" name="first_name" placeholder="First Name"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <input type="text" name="last_name" placeholder="Last Name"
                                                        required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-input-item">
                                            <input type="email" name="email" placeholder="Enter your Email" required />
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <input type="password" name="password"
                                                        placeholder="Enter your Password" required />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="single-input-item">
                                                    <input type="password" name="password_confirmation"
                                                        placeholder="Repeat your Password" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-input-item">
                                            <label>Register as:</label>
                                            <div class="vendor-toggle">
                                                <div class="vendor-option active" data-value="0">Customer</div>
                                                <div class="vendor-option" data-value="1">Vendor</div>
                                            </div>
                                            <input type="hidden" name="is_pending_vendor" id="vendor-type" value="0">
                                        </div>

                                        <div class="single-input-item" id="phone-field" style="display: none;">
                                            <input type="tel" name="phone_number"
                                                placeholder="Enter your Phone Number" />
                                        </div>

                                        <div class="single-input-item">
                                            <button class="btn-login">Register</button>
                                        </div>
                                        <a href="#login" class="auth-link" data-toggle="tab">Already have an account?
                                            Login here</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Login & Register Content End -->
            </div>
        </div>
    </div>
</div>
<!--== Page Content Wrapper End ==-->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vendor toggle functionality
    const vendorOptions = document.querySelectorAll('.vendor-option');
    const vendorTypeInput = document.getElementById('vendor-type');
    const phoneField = document.getElementById('phone-field');

    vendorOptions.forEach(option => {
        option.addEventListener('click', function() {
            vendorOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            const value = this.dataset.value;
            vendorTypeInput.value = value;

            // Show/hide phone field
            phoneField.style.display = value === '1' ? 'block' : 'none';
        });
    });
});
</script>

@endsection