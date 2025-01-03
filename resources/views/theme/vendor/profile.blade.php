@extends('theme.master')
@section('title', 'Your Profile')
@section('content')

<div class="handeva-profile">
    <div class="handeva-profile-container">
        <div class="handeva-profile-grid">
            <!-- Left Section -->
            <div class="handeva-profile-sidebar">
                <div class="handeva-profile-avatar">
                    <div class="handeva-profile-circle">
                        {{ strtoupper(substr($vendor->first_name, 0, 1))}}{{strtoupper(substr($vendor->last_name, 0, 1)) }}
                    </div>
                    <div class="handeva-profile-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                </div>
                <h2 class="handeva-profile-name">{{ $vendor->first_name }} {{ $vendor->last_name }}</h2>
                <p class="handeva-profile-bio">{{ $vendor->email }}</p>
            </div>

            <!-- Right Section -->
            <div class="handeva-profile-form">
                <h3 class="handeva-profile-form-title">Edit Profile Information</h3>
                <form action="{{ route('vendor.updateAccount') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="handeva-form-group">
                        <label class="handeva-form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="handeva-form-input"
                            value="{{ $vendor->first_name }}" required>
                    </div>

                    <div class="handeva-form-group">
                        <label class="handeva-form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="handeva-form-input"
                            value="{{ $vendor->last_name }}" required>
                    </div>

                    <div class="handeva-form-group">
                        <label class="handeva-form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="handeva-form-input"
                            value="{{ $vendor->email }}" required>
                    </div>

                    <div class="handeva-form-group">
                        <label class="handeva-form-label" for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="handeva-form-input"
                            value="{{ $vendor->phone_number }}" required>
                    </div>


                    <div class="handeva-form-group">
                        <label class="handeva-form-label" for="bio">Bio</label>
                        <textarea id="bio" name="bio"
                            class="handeva-form-input handeva-form-textarea">{{ $vendor->bio }}</textarea>
                    </div>

                    <div class="handeva-form-section">
                        <h4 class="handeva-profile-form-title">Change Password</h4>
                        <div class="handeva-form-group">
                            <label class="handeva-form-label" for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password"
                                class="handeva-form-input" autocomplete="off">
                        </div>


                        <div class="handeva-form-group">
                            <label class="handeva-form-label" for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password" class="handeva-form-input">
                        </div>

                        <div class="handeva-form-group">
                            <label class="handeva-form-label" for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="handeva-form-input">
                        </div>
                    </div>

                    <button type="submit" class="handeva-btn-update">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection