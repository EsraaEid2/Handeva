// resources/views/vendor/sections/account_details.blade.php

<form action="{{ route('vendor.updateAccount') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $vendor->first_name }}">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $vendor->last_name }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $vendor->email }}">
    </div>
    <div class="form-group">
        <label for="profile_pic">Profile Picture</label>
        <input type="file" name="profile_pic" class="form-control">
    </div>
    <div class="form-group">
        <label for="social_links">Social Links</label>
        <input type="text" name="social_links" class="form-control" value="{{ $vendor->social_links }}">
    </div>
    <div class="form-group">
        <label for="bio">Bio</label>
        <textarea name="bio" class="form-control">{{ $vendor->bio }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>