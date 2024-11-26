@extends('layouts.master')

@section('title', 'Products')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4>View Products</h4>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ url('admin/products') }}"
            class="mb-4 mt-4 d-flex justify-content-between align-items-center">
            <div class="input-group w-50">
                <input type="text" class="form-control border-primary rounded-pill py-2" name="search"
                    placeholder="Search Products" value="{{ request('search') }}">
                <!-- <button class="btn btn-primary rounded-pill px-4" type="submit">
                    <i class="fas fa-search"></i> Search
                </button> -->
            </div>
        </form>

        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
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
                <tbody>
                    @forelse($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @if($item->primaryImage)
                            <img src="{{ asset('uploads/product/'.$item->primaryImage->image_path) }}"
                                alt="Primary Image" width="50" height="50" class="rounded">
                            @else
                            <span>No Image</span>
                            @endif
                        </td>

                        <td>{{ $item->price }}</td>
                        <td>{{ $item->stock_quantity }}</td>
                        <td>
                            <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editProductModal{{ $item->id }}">
                                <i class="fas fa-edit fa-lg"></i>
                            </a>
                            <a href="#" class="text-danger mx-2" title="Delete"
                                onclick="event.preventDefault(); deleteProduct('{{ $item->id }}')">
                                <i class="fas fa-trash-alt fa-lg"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editProductModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/products/'.$item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="title">Product Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $item->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Product Description</label>
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $item->description }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="stock_quantity">Stock Quantity</label>
                                            <input type="text" name="stock_quantity" class="form-control"
                                                value="{{ $item->stock_quantity}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="is_customizable">Customizable</label>
                                            <select name="is_customizable" class="form-control" required>
                                                <option value="1" {{ $item->is_customizable == 1 ? 'selected' : '' }}>
                                                    Yes</option>
                                                <option value="0" {{ $item->is_customizable == 0 ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Update Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    @empty
                    <tr>
                        <td colspan="5">No Products found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $products->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('successUpdate'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Updated Successfully',
    text: '{{ session('
    successUpdate ') }}',
    showConfirmButton: false,
    timer: 3000
});
</script>
@endif

@if(session('successAdd'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Added Successfully',
    text: '{{ session('
    successAdd ') }}',
    showConfirmButton: false,
    timer: 3000
});
</script>
@endif

@if(session('successDelete'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Deleted Successfully',
    text: '{{ session('
    successDelete ') }}',
    showConfirmButton: false,
    timer: 3000
});
</script>
@endif

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        'Content-Type': 'application/json', // Ensure the content type is set
                    }
                })
                .then(response => response.json()) // Assuming the controller returns a JSON response
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'The user has been deleted.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page after successful deletion
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
<!-- 000000000000000000000000000000000000000000000000000000000000000000 -->