// resources/views/vendor/sections/upload_product.blade.php

<form action="{{ route('vendor.uploadProduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" class="form-control">
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" class="form-control">
            <!-- Populate categories from the database -->
        </select>
    </div>
    <div class="form-group">
        <label for="is_traditional">Is Traditional</label>
        <input type="checkbox" name="is_traditional">
    </div>
    <div class="form-group">
        <label for="is_customizable">Is Customizable</label>
        <input type="checkbox" name="is_customizable">
    </div>
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="text" name="discount" class="form-control">
    </div>
    <div class="form-group">
        <label for="images">Product Images</label>
        <input type="file" name="images[]" multiple class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Upload Product</button>
</form>