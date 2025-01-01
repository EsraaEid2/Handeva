@extends('layouts.master') @section('title', 'Roles Management') @section('content') <div
    class="container-fluid px-4 py-3">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Roles</h4> <button class="btn btn-outline-primary btn-sm"
                data-bs-toggle="modal" data-bs-target="#addRoleModal"> <i class="fas fa-plus-circle"></i> Add Role
            </button>
        </div>
        <div class="admin-card-body">
            <table id="rolesTable"
                class="admin-table dataTable table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Role Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody> @forelse($roles as $item) <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->role_type }}</td>
                        <td> <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                data-bs-target="#editRoleModal{{ $item->id }}"> <i class="fas fa-edit fa-lg"></i> </a>
                            <a href="#" class="text-danger mx-2" title="Delete"
                                onclick="event.preventDefault(); deleteRole('{{ $item->id }}')"> <i
                                    class="fas fa-trash-alt fa-lg"></i> </a>
                        </td>
                    </tr> <!-- Edit Role Modal -->
                    <div class="modal fade" id="editRoleModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editRoleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5> <button type="button"
                                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/roles/'.$item->id) }}" method="POST"
                                        enctype="multipart/form-data"> @csrf @method('PUT') <div class="mb-3"> <label
                                                for="role_type" class="form-label">Role Type</label> <input type="text"
                                                name="role_type" class="form-control" value="{{ $item->role_type }}"
                                                required> </div>
                                        <div class="text-center"> <button type="submit" class="btn btn-primary">Update
                                                Role</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> @empty <tr>
                        <td colspan="3" class="text-muted">No Roles found</td>
                    </tr> @endforelse
                </tbody>
            </table>
        </div>
    </div> <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5> <button type="button"
                        class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('roles.store') }}" method="POST"> @csrf <div class="mb-3"> <label
                                for="role_type" class="form-label">Role Type</label> <input type="text" name="role_type"
                                class="form-control" required> </div>
                        <div class="text-center"> <button type="submit" class="btn btn-primary">Add Role</button> </div>
                    </form>
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

    <script>
    function deleteRole(roleId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/roles/${roleId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            Swal.fire('Deleted!', data.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Error!', data.message, 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error!', 'An unexpected error occurred.', 'error'));
            }
        });
    }
    </script>

    @endsection