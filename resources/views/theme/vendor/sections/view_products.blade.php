<div class="table-responsive">
    <table id="products-table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm edit-product-btn" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <!-- Delete Button -->
                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-product-btn"
                            onclick="return confirm('Are you sure?')">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach($products as $product)
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('vendor/products/'.$product->id) }}" method="POST" class="vendordashboard-form">
                    @csrf
                    @method('PUT')
                    <div class="vendordashboard-form-group">
                        <label for="edit-title-{{ $product->id }}" class="form-label">Title</label>
                        <input type="text" id="edit-title-{{ $product->id }}" name="title"
                            class="vendordashboard-form-control" value="{{ $product->title }}" required>
                    </div>
                    <div class="vendordashboard-form-group">
                        <label for="edit-description-{{ $product->id }}" class="form-label">Description</label>
                        <textarea id="edit-description-{{ $product->id }}" name="description"
                            class="vendordashboard-form-control" rows="3"
                            required>{{ $product->description }}</textarea>
                    </div>
                    <div class="vendordashboard-form-group">
                        <label for="edit-category-{{ $product->id }}" class="form-label">Category</label>
                        <select id="edit-category-{{ $product->id }}" name="category_id"
                            class="vendordashboard-form-control" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="vendordashboard-form-group">
                        <label for="edit-price-{{ $product->id }}" class="form-label">Price</label>
                        <input type="number" id="edit-price-{{ $product->id }}" name="price"
                            class="vendordashboard-form-control" value="{{ $product->price }}" step="0.01" required>
                    </div>
                    <div class="vendordashboard-form-group">
                        <label for="edit-price-{{ $product->id }}" class="form-label">Stock Quantity</label>
                        <input type="number" id="edit-price-{{ $product->id }}" name="stock_quantity"
                            class="vendordashboard-form-control" value="{{ $product->stock_quantity }}" step="0.01"
                            required>
                    </div>
                    <div class="vendordashboard-form-group">
                        <div class="form-check">
                            <input type="checkbox" id="edit-visible-{{ $product->id }}" name="is_visible"
                                class="form-check-input" {{ $product->is_visible ? 'checked' : '' }}>
                            <label for="edit-visible-{{ $product->id }}" class="form-check-label">Visible</label>
                        </div>
                    </div>
                    <div class="vendordashboard-form-group">
                        <div class="form-check">
                            <input type="checkbox" id="edit-customizable-{{ $product->id }}" name="is_customizable"
                                class="form-check-input" {{ $product->is_customizable ? 'checked' : '' }}>
                            <label for="edit-customizable-{{ $product->id }}"
                                class="form-check-label">Customizable</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="vendordashboard-btn">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach