@extends('layouts.master')

@section('title', 'Reviews')

@section('content')
<style>
.icon-button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
}

.icon-button:hover i {
    opacity: 0.8;
    transform: scale(1.1);
}

.text-success {
    color: #28a745;
    /* Green for Approve */
}

.text-danger {
    color: #dc3545;
    /* Red for Reject */
}
</style>

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>View Pending Reviews</h4>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ url('admin/reviews') }}"
            class="mb-4 mt-4 d-flex justify-content-between align-items-center">
            <div class="input-group w-50">
                <input type="text" class="form-control border-primary rounded-pill py-2" name="search"
                    placeholder="Search Revie" value="{{ request('search') }}">
                <button class="btn btn-primary rounded-pill px-4" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Product ID</th>
                        <th>User ID</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product_id }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->rating }}</td>
                        <td>{{ $item->comment }}</td>
                        <td>
                            <!-- Approve Icon Button -->
                            <form action="{{ route('admin.reviews.approve', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="icon-button text-success" data-bs-toggle="tooltip"
                                    title="Approve">
                                    <i class="fas fa-check-circle fa-lg"></i>
                                </button>
                            </form>

                            <!-- Reject Icon Button -->
                            <form action="{{ route('admin.reviews.reject', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="icon-button text-danger" data-bs-toggle="tooltip"
                                    title="Reject">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </button>
                            </form>
                        </td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No reviews found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $reviews->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

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
@endsection