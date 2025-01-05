@extends('layouts.master')

@section('title', 'Product Customizations')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="admin-card mt-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Customizations</h4>
            <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2" data-bs-toggle="modal"
                data-bs-target="#addCustomizationModal">
                <i class="fas fa-plus-circle"></i> <span>Add Customization</span>
            </button>
        </div>
        <div class="admin-card-body">
            <table class="admin-table table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Custom Type</th>
                        <th>Options</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customizations as $customization)
                    <tr>
                        <td>{{ $customization->id }}</td>
                        <td>{{ $customization->custom_type }}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach ($customization->options as $option)
                                <li>{{ $option->option_value }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm custom-edit-btn" data-bs-toggle="modal"
                                data-bs-target="#editCustomizationModal{{ $customization->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form id="delete-form-{{ $customization->id }}"
                                action="{{ route('admin.customizations.destroy', $customization->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm custom-delete-btn"
                                    data-id="{{ $customization->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>

                    </tr>

                    <!-- Edit Customization Modal -->
                    <div class="modal fade" id="editCustomizationModal{{ $customization->id }}" tabindex="-1"
                        aria-labelledby="editCustomizationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCustomizationModalLabel">Edit Customization</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.customizations.update', $customization->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="custom_type{{ $customization->id }}" class="form-label">Custom
                                                Type</label>
                                            <input type="text" id="custom_type{{ $customization->id }}"
                                                name="custom_type" class="form-control"
                                                value="{{ $customization->custom_type }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="options{{ $customization->id }}"
                                                class="form-label">Options</label>
                                            <div id="optionsContainer{{ $customization->id }}">
                                                @foreach ($customization->options as $option)
                                                <input type="text" name="options[]" class="form-control mb-2"
                                                    value="{{ $option->option_value }}" required>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="addOption({{ $customization->id }})">Add Option</button>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="4" class="text-muted">No customizations found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Customization Modal -->
    <div class="modal fade" id="addCustomizationModal" tabindex="-1" aria-labelledby="addCustomizationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomizationModalLabel">Add New Customization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.customizations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="custom_type" class="form-label">Custom Type</label>
                            <input type="text" id="custom_type" name="custom_type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="options" class="form-label">Options</label>
                            <div id="optionsContainer">
                                <input type="text" name="options[]" class="form-control mb-2" required>
                            </div>
                            <button type="button" class="btn btn-sm btn-info" onclick="addOption()">Add Option</button>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Customization</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addOption(containerId = null) {
    const container = containerId ? document.getElementById(`optionsContainer${containerId}`) : document.getElementById(
        'optionsContainer');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'options[]';
    input.className = 'form-control mb-2';
    input.required = true;
    container.appendChild(input);
}
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.custom-delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const customizationId = this.getAttribute('data-id');
            const form = document.getElementById(`delete-form-${customizationId}`);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@endsection