@extends('layouts.master')

@section('content')
<h1>Pending Reviews</h1>

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>User</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
        <tr>
            <td>{{ $review->product->name }}</td>
            <td>{{ $review->user->name }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->comment }}</td>
            <td>
                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection