@extends('layouts.master')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <div class="admin-card">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h4 class="admin-card-title">View Categories</h4>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2" data-bs-toggle="modal"
                    data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus-circle"></i> <span>Add Category</span>
                </button>
            </div>
        </div>
        <div class="admin-card-body">
            <div class="table-responsive">
                <table class="admin-table dataTable table-hover text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Category Picture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $item)
                        <tr>
                            <td data-label="ID">{{ $item->id }}</td>
                            <td data-label="Name">{{ $item->name }}</td>
                            <td data-label="Image">
                                <img src="{{ asset('uploads/category/'.$item->image) }}" alt="Category Image" width="50"
                                    height="50" class="rounded shadow-sm">
                            </td>
                            <td data-label="Actions">
                                <a href="#" class="text-success mx-2" title="Edit" data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal{{ $item->id }}">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <a href="#" class="text-danger mx-2" title="Delete"
                                    onclick="event.preventDefault(); deleteCategory('{{ $item->id }}')">
                                    <i class="fas fa-trash-alt fa-lg"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Category Modal -->
                        <div class="modal fade" id="editCategoryModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('admin/update-category/'.$item->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Category Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Category Description</label>
                                                <textarea name="description" class="form-control"
                                                    required>{{ $item->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Category Image</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Update Category</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted">No categories found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/add-category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Category Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image">Category Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection