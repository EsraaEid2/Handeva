@extends('layouts.master')

@section('content')
<h1>Manage Reviews</h1>
<table>
    <thead>
        <tr>
            <th>Product</th>
            <th>User</th>
            <th>Rating</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
        <tr>
            <td>{{ $review->product->title }}</td>
            <td>{{ $review->user->name }}</td>
            <td>{{ $review->rating }}</td>
            <td>{{ $review->comment }}</td>
            <td>{{ $review->status }}</td>
            <td>
                @if($review->status == 'pending')
                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
                <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
                @else
                <p>Already approved</p>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection