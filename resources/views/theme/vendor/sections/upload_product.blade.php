<form action="{{ route('vendor.uploadProduct') }}" method="POST" enctype="multipart/form-data" id="product-upload-form">
    @csrf
    <div class="form-group">
        <label for="title">Product Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter product title" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Enter product description"
            required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter product price" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" name="stock_quantity" class="form-control" placeholder="Enter stock quantity" required>
    </div>
    <div class="form-group">
        <label for="is_traditional">Is Traditional</label>
        <input type="checkbox" name="is_traditional" id="is_traditional">
    </div>
    <div class="form-group">
        <label for="is_customizable">Is Customizable</label>
        <input type="checkbox" name="is_customizable" id="is_customizable">
    </div>
    <div class="form-group" id="customization-section" style="display: none;">
        <label for="custom_type">Customization Type</label>
        <select name="custom_type" class="form-control">
            <option value="" disabled selected>Select customization type</option>
            @foreach ($customizations as $customization)
            <option value="{{ $customization->id }}">{{ $customization->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" step="0.01" name="discount" class="form-control" placeholder="Enter discount percentage">
    </div>
    <div class="form-group">
        <label for="images">Product Images (Max 3)</label>
        <input type="file" name="images[]" multiple accept="image/*" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload Product</button>
</form>