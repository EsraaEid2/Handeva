@extends('layouts.master') @section('title', 'Products') @section('content') <div class="container-fluid px-4 py-3">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Products</h4>
        </div>
        <div class="admin-card-body">
            <table id="productsTable"
                class="admin-table dataTable table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Product Title</th>
                        <th>Product Images</th>
                        <th>Product Price</th>
                        <th>Stock Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> @forelse($products as $item) <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td> @if($item->primaryImage)
                            <img src="{{ asset('product_images/'.$item->primaryImage->image_url) }}" alt="Primary Image"
                                width="50" height="50" class="rounded shadow-sm">
                            @else <span>No
                                Image</span> @endif
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->stock_quantity }}</td>
                        <td class="flexed-icons"> <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $item->id }}"> <i class="fas fa-edit fa-lg"></i>
                            </a> <a href="#" class="text-danger mx-2" title="Delete"
                                onclick="event.preventDefault(); deleteProduct('{{ $item->id }}')"> <i
                                    class="fas fa-trash-alt fa-lg"></i> </a> </td>
                    </tr> <!-- Edit Product Modal -->
                    <div class="modal fade" id="editProductModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5> <button
                                        type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/products/'.$item->id) }}" method="POST"
                                        enctype="multipart/form-data"> @csrf @method('PUT') <div class="mb-3"> <label
                                                for="title" class="form-label">Product Title</label> <input type="text"
                                                name="title" class="form-control" value="{{ $item->title }}" required>
                                        </div>
                                        <div class="mb-3"> <label for="description" class="form-label">Product
                                                Description</label> <input type="text" name="description"
                                                class="form-control" value="{{ $item->description }}" required> </div>
                                        <div class="mb-3"> <label for="stock_quantity" class="form-label">Stock
                                                Quantity</label> <input type="text" name="stock_quantity"
                                                class="form-control" value="{{ $item->stock_quantity}}"> </div>
                                        <div class="mb-3"> <label for="is_customizable"
                                                class="form-label">Customizable</label> <select name="is_customizable"
                                                class="form-control" required>
                                                <option value="1" {{ $item->is_customizable == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0" {{ $item->is_customizable == 0 ? 'selected' : '' }}>No
                                                </option>
                                            </select> </div>
                                        <div class="text-center"> <button type="submit" class="btn btn-primary">Update
                                                Product</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> @empty <tr>
                        <td colspan="6" class="text-muted">No Products found</td>
                    </tr> @endforelse
                </tbody>
            </table>
            <script>
            $(document).ready(function() {
                $('#productsTable').DataTable();
            });
            </script>
            <script>
            function deleteProduct(userId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Use fetch to send a DELETE request
                        fetch(`/admin/products/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute(
                                            'content'),
                                    'Content-Type': 'application/json', // Ensure the content type is set
                                }
                            })
                            .then(response => response
                                .json()) // Assuming the controller returns a JSON response
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'The user has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location
                                            .reload(); // Reload the page after successful deletion
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while trying to delete the user.',
                                    'error'
                                );
                            });
                    }
                });
            }
            </script>

            @endsection