@extends('layouts.master')

@section('content')
<h1>Add User</h1>
<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection