@extends('layouts.master')

@section('title', 'Orders')

@section('content')

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>View Orders</h4>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ url('admin/categories') }}"
            class="mb-4 mt-4 d-flex justify-content-between align-items-center">
            <div class="input-group w-50">
                <input type="text" class="form-control border-primary rounded-pill py-2" name="search"
                    placeholder="Search Orders" value="{{ request('search') }}">
                <button class="btn btn-primary rounded-pill px-4" type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>

        <div class="card-body">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ $order->total_price }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->id }}">
                                <i class="fas fa-eye"></i>
                            </a>

                        </td>
                    </tr>

                    <!-- View Order Modal -->
                    <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="viewOrderModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewOrderModalLabel">Order Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                                    <p><strong>User:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                                    <p><strong>Total Price:</strong> JOD {{ $order->total_price }}</p>
                                    <p><strong>Placed At:</strong> {{ $order->created_at->format('d-m-Y') }}</p>

                                    <h3>Items</h3>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->product ? $item->product->title : 'No Title Available' }}
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ $item->price_at_time }}</td>
                                                <td>${{ $item->total_price }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6">No orders found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $orders->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
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

<script>
function deleteCategory(categoryId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/delete-category/' + categoryId;
        }
    });
}
</script>

@endsection