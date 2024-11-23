@extends('layouts.master')

@section('content')
<h1>Contact Us Messages</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Subject</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
        <tr>
            <td>{{ $message->id }}</td>
            <td>{{ $message->user->name }}</td>
            <td>{{ $message->subject }}</td>
            <td>
                <a href="{{ route('contact_us.show', $message->id) }}" class="btn btn-info">View</a>
                <form action="{{ route('contact_us.destroy', $message->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection