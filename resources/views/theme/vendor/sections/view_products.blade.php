<div class="product-management-container">
    <!-- Product Table Section -->
    <div class="table-container">
        <table id="products-table" class="products-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th class="hide-on-mobile">Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div class="product-title">{{ $product->title }}</div>
                        <div class="mobile-only category-label">{{ $product->category->name }}</div>
                    </td>
                    <td class="hide-on-mobile">{{ $product->category->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-edit" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $product->id }}">
                                <i class="fa fa-edit"></i>
                                <span class="hide-on-mobile">Edit</span>
                            </button>
                            <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST"
                                class="delete-form" id="delete-form-{{ $product->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete"
                                    onclick="confirmDelete({{ $product->id }})">
                                    <i class="fa fa-trash"></i>
                                    <span class="hide-on-mobile">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    @foreach($products as $product)
    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('vendor/products/'.$product->id) }}" method="POST" class="edit-product-form">
                        @csrf
                        @method('PUT')
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="edit-title-{{ $product->id }}">Title</label>
                                <input type="text" id="edit-title-{{ $product->id }}" name="title"
                                    value="{{ $product->title }}" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="edit-description-{{ $product->id }}">Description</label>
                                <textarea id="edit-description-{{ $product->id }}" name="description" rows="3"
                                    required>{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit-category-{{ $product->id }}">Category</label>
                                <select id="edit-category-{{ $product->id }}" name="category_id" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit-price-{{ $product->id }}">Price</label>
                                <input type="number" id="edit-price-{{ $product->id }}" name="price"
                                    value="{{ $product->price }}" step="0.01" required>
                            </div>

                            <div class="form-group">
                                <label for="edit-stock-{{ $product->id }}">Stock Quantity</label>
                                <input type="number" id="edit-stock-{{ $product->id }}" name="stock_quantity"
                                    value="{{ $product->stock_quantity }}" required>
                            </div>

                            <div class="form-toggles">
                                <div class="toggle-group">
                                    <input type="checkbox" id="edit-visible-{{ $product->id }}" name="is_visible"
                                        {{ $product->is_visible ? 'checked' : '' }}>
                                    <label for="edit-visible-{{ $product->id }}">Visible</label>
                                </div>

                                <div class="toggle-group">
                                    <input type="checkbox" id="edit-customizable-{{ $product->id }}"
                                        name="is_customizable" {{ $product->is_customizable ? 'checked' : '' }}>
                                    <label for="edit-customizable-{{ $product->id }}">Customizable</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>