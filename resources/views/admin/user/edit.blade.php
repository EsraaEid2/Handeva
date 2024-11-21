@extends('layouts.master')

@section('content')
<h1>Edit User</h1>
<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- First Name -->
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
    </div>

    <!-- Last Name -->
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <!-- Role -->
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <!-- Password -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
        <small>Leave blank if not changing password</small>
    </div>

    <!-- Confirm Password -->
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection