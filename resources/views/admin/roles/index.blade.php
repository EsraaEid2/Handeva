@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Roles Management</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Create New Role</a>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Role Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ ucfirst($role->role_type) }}</td>
                <td>
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection