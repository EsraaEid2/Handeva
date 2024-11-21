<!-- resources/views/admin/product_images/create.blade.php -->

@extends('layouts.master')

@section('content')
<h1>Add Image to Product: {{ $product->title }}</h1>

<form action="{{ route('admin.product_images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image_url">Image</label>
        <input type="file" name="image_url" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="is_primary">Set as Primary Image</label>
        <input type="checkbox" name="is_primary" value="1">
    </div>

    <button type="submit" class="btn btn-primary">Add Image</button>
</form>
@endsection