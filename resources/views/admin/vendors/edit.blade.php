@extends('layouts.master')

@section('content')
<h1>Edit Vendor</h1>
<form action="{{ route('admin.vendors.update', $vendor->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="role_id">Role</label>
        <select name="role_id" class="form-control" required>
            @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ $vendor->role_id == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $vendor->first_name }}" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $vendor->last_name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $vendor->email }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
        <small>Leave blank if not changing</small>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>
@endsection