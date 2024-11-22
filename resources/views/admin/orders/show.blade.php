@extends('admin.layouts.app')

@section('content')
<h1>Order #{{ $order->id }} Details</h1>

<div>
    <p>User: {{ $order->user->name }}</p>
    <p>Total Price: ${{ $order->total_price }}</p>
    <p>Status: {{ ucfirst($order->status) }}</p>
</div>

<h2>Order Items</h2>
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price at Time</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>${{ $item->price_at_time }}</td>
            <td>${{ $item->quantity * $item->price_at_time }}</td>
            <td>
                <a href="{{ route('admin.order-items.update-quantity', $item->id) }}">Update Quantity</a>
                <a href="{{ route('admin.order-items.adjust-price', $item->id) }}">Adjust Price</a>
                <a href="{{ route('admin.order-items.destroy', $item->id) }}">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection