<form action="{{ route('vendor.updateAccount') }}" method="POST" enctype="multipart/form-data"
    class="vendordashboard-update-account-form" onsubmit="saveActiveSection('update-account-section')">
    @csrf
    <div class="vendordashboard-profile-pic-container">

        <!-- Circle with User Initial -->
        <div class="rounded-circle d-flex justify-content-center align-items-center text-white mx-auto mb-3"
            style="width: 100px; height: 100px; background-color: #D82E2E; font-size: 36px;">
            {{ strtoupper(substr($vendor->first_name, 0, 1))}}{{strtoupper(substr($vendor->last_name, 0, 1)) }}
        </div>
    </div>

    <div class="vendordashboard-form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="vendordashboard-form-control" value="{{ $vendor->first_name }}">
    </div>
    <div class="vendordashboard-form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="vendordashboard-form-control" value="{{ $vendor->last_name }}">
    </div>
    <div class="vendordashboard-form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="vendordashboard-form-control" value="{{ $vendor->email }}">
    </div>
    <label for="social_links">Social Links</label>
    <div class="vendordashboard-form-group vendordashboard-attachment-field">
        <input type="text" name="social_links" class="vendordashboard-form-control vendordashboard-attachment-input"
            placeholder="Add your social link">
    </div>
    <div class="vendordashboard-form-group">
        <label for="bio">Bio</label>
        <textarea name="bio" class="vendordashboard-form-control">{{ $vendor->bio }}</textarea>
    </div>
    <hr>
    <h4>Change Password</h4>
    <div class="vendordashboard-form-group">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" class="vendordashboard-form-control">
    </div>
    <div class="vendordashboard-form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" class="vendordashboard-form-control">
    </div>
    <div class="vendordashboard-form-group">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" name="confirm_password" class="vendordashboard-form-control">
    </div>
    <button type="submit" class="vendordashboard-btn">Update</button>
</form>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif