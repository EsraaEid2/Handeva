@extends('layouts.master')

@section('title', 'Reviews')

@section('content')
<style>
.icon-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    transition: transform 0.2s, opacity 0.2s;
}

.icon-button:hover i {
    opacity: 0.8;
    transform: scale(1.2);
}

.text-success {
    color: #28a745;
}

.text-danger {
    color: #dc3545;
}

.text-info {
    color: #17a2b8;
}

.badge-status {
    font-size: 0.9rem;
    padding: 0.5em 1em;
    border-radius: 0.75em;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-success {
    background-color: #28a745;
    color: #fff;
}

.badge-danger {
    background-color: #dc3545;
    color: #fff;
}

.search-form .form-control,
.search-form .form-select {
    border-radius: 50px;
}

.search-form button {
    border-radius: 50px;
    padding: 10px 20px;
}

.search-form input,
.search-form select {
    width: 100%;
}
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Manage Reviews</h4>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ url('admin/reviews') }}" class="search-form mb-4 mt-4">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-8 mb-2">
                    <select name="status" class="form-select border-primary rounded-pill"
                        title="Filter reviews by their approval status">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved
                        </option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected
                        </option>
                    </select>
                </div>
                <div class="col-md-2 col-sm-4 mb-2 d-flex">
                    <button class="btn btn-primary rounded-pill w-100" type="submit">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <div class="col-md-2 col-sm-4 mb-2 d-flex">
                    <a href="{{ url('admin/reviews') }}" class="btn btn-secondary rounded-pill w-100">
                        <i class="fas fa-eraser"></i> Clear
                    </a>
                </div>
            </div>
        </form>

        <!-- Reviews Table -->
        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->product->title ?? 'N/A' }}</td>
                        <td>{{ $review->user->first_name . ' ' . $review->user->last_name }}</td>
                        <td>{{ $review->rating }}/5</td>
                        <td>{{ $review->comment }}</td>
                        <td>
                            <span class="badge badge-status 
                                @if($review->status == 'approved') badge-success 
                                @elseif($review->status == 'rejected') badge-danger 
                                @else badge-warning 
                                @endif">
                                {{ ucfirst($review->status) }}
                            </span>
                        </td>
                        <td>
                            @if($review->status === 'pending')
                            <!-- Approve Button -->
                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="icon-button text-success" data-bs-toggle="tooltip"
                                    title="Approve">
                                    <i class="fas fa-check-circle fa-lg"></i>
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="icon-button text-danger" data-bs-toggle="tooltip"
                                    title="Reject">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </button>
                            </form>
                            @else
                            <span data-bs-toggle="tooltip" title="No actions available">
                                <i class="fas fa-info-circle text-info fa-lg"></i>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">No reviews found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $reviews->appends(['status' => request('status')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection