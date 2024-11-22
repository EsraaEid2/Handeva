@extends('layouts.master')

@section('content')
<h1>Edit Product</h1>

<!-- Form to edit the product -->
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <!-- Specify that this is an UPDATE request -->

    <!-- Product Title -->
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Product Description -->
    <div class="form-group">
        <label for="description">Product Description</label>
        <textarea name="description" class="form-control" rows="4"
            required>{{ old('description', $product->description) }}</textarea>
        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Product Price -->
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}"
            required>
        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Category -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->title }}
            </option>
            @endforeach
        </select>
        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Stock Quantity -->
    <div class="form-group">
        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" class="form-control"
            value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        @error('stock_quantity') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Visibility -->
    <div class="form-group">
        <label for="is_visible">Visible</label>
        <input type="checkbox" name="is_visible" {{ old('is_visible', $product->is_visible) ? 'checked' : '' }}>
        @error('is_visible') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Is Traditional -->
    <div class="form-group">
        <label for="is_traditional">Traditional</label>
        <input type="checkbox" name="is_traditional"
            {{ old('is_traditional', $product->is_traditional) ? 'checked' : '' }}>
        @error('is_traditional') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Is Customizable -->
    <div class="form-group">
        <label for="is_customizable">Customizable</label>
        <input type="checkbox" name="is_customizable"
            {{ old('is_customizable', $product->is_customizable) ? 'checked' : '' }}>
        @error('is_customizable') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Price After Discount -->
    <div class="form-group">
        <label for="price_after_discount">Price After Discount (Optional)</label>
        <input type="number" step="0.01" name="price_after_discount" class="form-control"
            value="{{ old('price_after_discount', $product->price_after_discount) }}">
        @error('price_after_discount') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <!-- Profile Picture Upload (Optional) -->
    <div class="form-group">
        <label for="profile_pic">Product Image</label>
        <input type="file" name="profile_pic" class="form-control">
        @error('profile_pic') <span class="text-danger">{{ $message }}</span> @enderror
        @if ($product->profile_pic)
        <div class="mt-2">
            <label>Current Image:</label><br>
            <img src="{{ asset('storage/'.$product->profile_pic) }}" alt="Product Image" width="100">
        </div>
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success">Update Product</button>
</form>

@endsection