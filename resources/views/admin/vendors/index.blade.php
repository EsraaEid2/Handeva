@extends('layouts.master')

@section('content')
<h1>Vendors</h1>
<a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">Add Vendor</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendors as $vendor)
        <tr>
            <td>{{ $vendor->id }}</td>
            <td>{{ $vendor->first_name }}</td>
            <td>{{ $vendor->last_name }}</td>
            <td>{{ $vendor->email }}</td>
            <td>{{ $vendor->role->name }}</td>
            <td>
                <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.vendors.destroy', $vendor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection