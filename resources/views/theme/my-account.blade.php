@extends('theme.master')
@section('title','My Account')
@section('content')

@include('theme.partials.hero',['title' => 'Member Area'])

<!--== Page Content Wrapper Start ==-->
<div class="body-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="profile-tab-menu">
                    <a href="#dashboard" class="active">Dashboard</a>
                    <a href="#orders">Order History</a>
                    <a href="#account-details">Account Details</a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="profile-tab-content">
                    <div id="dashboard" class="profile-section">

                        <h2 class="profile-header">Welcome Back,
                            {{ $user->first_name }}!
                        </h2>
                        <p class="welcoming_msg">From your dashboard, manage your orders, shipping, and account details.
                        </p>
                    </div>

                    <div id="orders" class="profile-section">
                        <h3 class="profile-header">Order History</h3>
                        <table class="profile-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td><button class="profile-btn">View</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="account-details" class="profile-section">
                        <h3 class="profile-header">Account Details</h3>
                        <div class="account-info">
                            <div class="info-item">
                                <label for="first_name">First Name:</label>
                                <p id="first_name">{{ $user->first_name }}</p>
                            </div>
                            <div class="info-item">
                                <label for="last_name">Last Name:</label>
                                <p id="last_name">{{ $user->last_name }}</p>
                            </div>
                            <div class="info-item">
                                <label for="email">Email:</label>
                                <p id="email">{{ $user->email }}</p>
                            </div>
                            <div class="info-item">
                                <label for="phone_number">Phone Number:</label>
                                <p id="phone_number">{{ $user->phone_number }}</p>
                            </div>
                            <div class="info-item">
                                <label for="address">Address:</label>
                                <p id="address">{{ $user->address }}</p>
                            </div>
                            <div class="info-item">
                                <label for="age">Age:</label>
                                <p id="age">{{ $user->age }}</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<!--== Page Content Wrapper End ==-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // تحديد جميع الروابط في القائمة
    const menuLinks = document.querySelectorAll('.profile-tab-menu a');

    // إضافة event listener لكل رابط
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // إزالة active class من جميع الروابط
            menuLinks.forEach(l => l.classList.remove('active'));

            // إضافة active class للرابط المختار
            this.classList.add('active');

            // إخفاء جميع الأقسام
            const sections = document.querySelectorAll('.profile-section, #dashboard');
            sections.forEach(section => section.style.display = 'none');

            // إظهار القسم المطلوب
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });
});
</script>
@endsection