@extends('layouts.master') @section('title', 'Vendors') @section('content') <div class="container-fluid px-4 py-3">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Vendors</h4>
        </div>
        <div class="admin-card-body">
            <table id="vendorsTable"
                class="admin-table dataTable table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Vendor Email</th>
                        <th>Products Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> @forelse($vendors as $item) <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->products_count }}</td>
                        <td> <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editVendorModal{{ $item->id }}"> <i class="fas fa-edit fa-lg"></i> </a>
                            <a href="#" class="text-danger mx-2" title="Delete"
                                onclick="event.preventDefault(); deleteVendor('{{ $item->id }}')"> <i
                                    class="fas fa-trash-alt fa-lg"></i> </a>
                        </td>
                    </tr> <!-- Edit Vendor Modal -->
                    <div class="modal fade" id="editVendorModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editVendorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editVendorModalLabel">Edit Vendor</h5> <button
                                        type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/vendors/'.$item->id) }}" method="POST"
                                        enctype="multipart/form-data"> @csrf @method('PUT') <div class="mb-3"> <label
                                                for="first_name" class="form-label">First Name</label> <input
                                                type="text" name="first_name" class="form-control"
                                                value="{{ $item->first_name }}" required> </div>
                                        <div class="mb-3"> <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ $item->last_name }}" required>
                                        </div>
                                        <div class="mb-3"> <label for="email" class="form-label">Vendor Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $item->email }}" required>
                                        </div>
                                        <div class="mb-3"> <label for="role_id" class="form-label">Vendor Role</label>
                                            <select name="role_id" class="form-control" required>
                                                <option value="" disabled selected>Select a Role</option>
                                                @foreach($roles as $role) <option value="{{ $role->id }}"
                                                    {{ $item->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_type }} </option> @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3"> <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $item->phone}}">
                                        </div>
                                        <div class="mb-3"> <label for="is_deleted" class="form-label">Status</label>
                                            <select name="is_deleted" class="form-control" required>
                                                <option value="0" {{ $item->is_deleted == 0 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="1" {{ $item->is_deleted == 1 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                        <div class="text-center"> <button type="submit" class="btn btn-primary">Update
                                                Vendor</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> @empty <tr>
                        <td colspan="6" class="text-muted">No Vendors found</td>
                    </tr> @endforelse
                </tbody>
            </table>
        </div>
        @if($errors->any())
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: `
            <ul style="text-align: left; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `,
            confirmButtonText: 'Okay'
        });
        </script>
        @endif
        <script>
        function deleteVendor(userId) {
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
                    fetch(`/admin/vendors/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute(
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