<!-- resources/views/admin/product_images/index.blade.php -->

@extends('layouts.master')

@section('content')
<h1>Product Images for: {{ $product->title }}</h1>

<a href="{{ route('admin.product_images.create', $product->id) }}" class="btn btn-success">Add New Image</a>

<div class="mt-3">
    @foreach($images as $image)
    <div class="image-card">
        <img src="{{ asset('storage/' . $image->image_url) }}" alt="Product Image" width="100">
        <div>
            <p>{{ $image->is_primary ? 'Primary' : 'Secondary' }}</p>
            <form action="{{ route('admin.product_images.destroy', [$product->id, $image->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection