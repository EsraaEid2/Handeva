<!-- resources/views/admin/roles/create.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create New Role</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="role_type">Role Type</label>
            <select name="role_type" id="role_type" class="form-control">
                <option value="customer">Customer</option>
                <option value="vendor">Vendor</option>
                <option value="admin">Admin</option>
            </select>

            @error('role_type')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Role</button>
    </form>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Back to Roles</a>
</div>
@endsection