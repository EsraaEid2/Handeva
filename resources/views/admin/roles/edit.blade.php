<!-- resources/views/admin/roles/edit.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Role</h1>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="role_type">Role Type</label>
            <select name="role_type" id="role_type" class="form-control">
                <option value="customer" {{ $role->role_type == 'customer' ? 'selected' : '' }}>Customer</option>
                <option value="vendor" {{ $role->role_type == 'vendor' ? 'selected' : '' }}>Vendor</option>
                <option value="admin" {{ $role->role_type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            @error('role_type')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Back to Roles</a>
</div>
@endsection