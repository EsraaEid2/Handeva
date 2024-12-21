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
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <!-- Delete Button -->
                    <form action="{{ route('vendor.products.destroy', $product->id) }}" method="POST"
                        class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
                <form action="{{ url('vendor/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit-title-{{ $product->id }}" class="form-label">Title</label>
                        <input type="text" id="edit-title-{{ $product->id }}" name="title" class="form-control"
                            value="{{ $product->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-category-{{ $product->id }}" class="form-label">Category</label>
                        <select id="edit-category-{{ $product->id }}" name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-price-{{ $product->id }}" class="form-label">Price</label>
                        <input type="number" id="edit-price-{{ $product->id }}" name="price" class="form-control"
                            value="{{ $product->price }}" step="0.01" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach