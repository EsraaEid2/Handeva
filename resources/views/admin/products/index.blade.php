@extends('layouts.master')

@section('content')
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Vendor</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>{{ $product->category->title }}</td>
            <td>{{ $product->vendor->first_name }} {{ $product->vendor->last_name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                <a href="{{ route('admin.products.show', $product->id) }}">View</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection