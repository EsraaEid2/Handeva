@extends('layouts.master') @section('title', 'Users') @section('content') <div class="container-fluid px-4 py-3">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Users</h4>
        </div>
        <div class="admin-card-body">
            <table id="usersTable"
                class="admin-table dataTable table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Email</th>
                        <th>User Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> @forelse($users as $item) <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role->role_type }}</td>
                        <td> <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editUserModal{{ $item->id }}"> <i class="fas fa-edit fa-lg"></i> </a>
                            <a href="#" class="text-danger mx-2" title="Delete"
                                onclick="event.preventDefault(); deleteUser('{{ $item->id }}')"> <i
                                    class="fas fa-trash-alt fa-lg"></i> </a>
                        </td>
                    </tr> <!-- Edit User Modal -->
                    <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5> <button type="button"
                                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/users/'.$item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="mb-3"> <label for="role_id" class="form-label">User Role</label>
                                            <select name="role_id" class="form-control" required>
                                                <option value="" disabled selected>Select a Role</option>
                                                @foreach($roles as $role) <option value="{{ $role->id }}"
                                                    {{ $item->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_type }}</option> @endforeach
                                            </select>
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
                                                User</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> @empty <tr>
                        <td colspan="6" class="text-muted">No Users found</td>
                    </tr> @endforelse
                </tbody>
            </table>
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
        function deleteUser(userId) {
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
                    fetch(`/admin/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content'),
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