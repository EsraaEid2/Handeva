<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Product Title</label>
        <input type="text" id="title" name="title" required>
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
    </div>

    <div>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" required>
    </div>

    <div>
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id" required>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" id="stock_quantity" name="stock_quantity" required>
    </div>

    <div>
        <label for="vendor_id">Vendor</label>
        <select id="vendor_id" name="vendor_id" required>
            @foreach ($vendors as $vendor)
            <option value="{{ $vendor->id }}">{{ $vendor->first_name }} {{ $vendor->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="is_visible">Visible</label>
        <input type="checkbox" id="is_visible" name="is_visible" value="1">
    </div>

    <div>
        <label for="is_traditional">Traditional</label>
        <input type="checkbox" id="is_traditional" name="is_traditional" value="1">
    </div>

    <div>
        <label for="is_customizable">Customizable</label>
        <input type="checkbox" id="is_customizable" name="is_customizable" value="1">
    </div>

    <div>
        <label for="price_after_discount">Price After Discount</label>
        <input type="number" id="price_after_discount" name="price_after_discount">
    </div>

    <button type="submit">Create Product</button>
</form>