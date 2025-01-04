@extends('theme.master')
@section('title','My Account')
@section('content')


<div class="body-wrapper">
    <div class="container">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-lg-3">
                <div class="profile-tab-menu">
                    <a href="#dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <a href="#orders"><i class="fas fa-box"></i> Order History</a>
                    <a href="#account-details"><i class="fas fa-user"></i> Account Details</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="profile-tab-content">
                    <!-- Dashboard Section -->
                    <div id="dashboard" class="profile-section">
                        <h2 class="profile-header">Welcome Back, {{ $user->first_name }}!</h2>
                        <p class="welcoming_msg">From your dashboard, manage your orders, shipping, and account details.
                        </p>
                    </div>

                    <!-- Order History Section -->
                    <div id="orders" class="profile-section">
                        <h3 class="profile-header">Order History</h3>

                        <!-- Filtering Options -->
                        <div class="filter-section mb-4">
                            <form action="{{ route('theme.my_account') }}" method="GET" class="row g-3">
                                <div class="col-md-3">
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="processing"
                                            {{ request('status') == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="delivered"
                                            {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="ep-add-to-cart">Filter</button>
                                </div>
                            </form>
                        </div>

                        <div class=" table-responsive">
                            <table class="profile-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ 
                                                $order->status == 'delivered' ? 'success' : 
                                                ($order->status == 'pending' ? 'warning' : 
                                                ($order->status == 'processing' ? 'info' : 'primary')) 
                                            }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>JOD {{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <button class="profile-btn view-order-btn" data-bs-toggle="modal"
                                                data-bs-target="#orderModal{{ $order->id }}"
                                                data-order-id="{{ $order->id }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No orders found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    </div>

                    <div id="account-details" class="profile-section">
                        <h3 class="profile-header">Account Details</h3>

                        <!-- Personal Information Form -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Personal Information</h5>
                                <button class="btn btn-primary btn-sm" id="editPersonalInfo">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <div class="card-body">
                                <form id="personalInfoForm" action="{{ route('user.update.profile') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ $user->first_name }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $user->last_name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" name="phone_number"
                                                value="{{ $user->phone_number }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Age</label>
                                            <input type="number" class="form-control" name="age"
                                                value="{{ $user->age }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $user->address }}" disabled>
                                        </div>
                                    </div>

                                    <div class="text-end" style="display: none;" id="personalInfoButtons">
                                        <button type="button" class="btn btn-secondary"
                                            id="cancelPersonalInfo">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Change Password Form -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Change Password</h5>
                            </div>
                            <div class="card-body">
                                <form id="passwordForm" action="{{ route('user.update.password') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                        <div class="form-text">Password must be at least 8 characters long.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            required>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($orders as $order)
<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Order #{{ $order->id }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="order-progress mb-4">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ 
                                    $order->status == 'delivered' ? '100' : 
                                    ($order->status == 'processing' ? '50' : 
                                    ($order->status == 'pending' ? '25' : '75')) 
                                 }}%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="{{ $order->status == 'pending' ? 'text-primary' : '' }}">Order Placed</span>
                        <span class="{{ $order->status == 'processing' ? 'text-primary' : '' }}">Processing</span>
                        <span class="{{ $order->status == 'delivered' ? 'text-primary' : '' }}">Delivered</span>
                    </div>
                </div>
                <div class="row">
                    @foreach($order->orderItems as $item)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $item->product ? $item->product->title : 'No Title Available' }}
                                </h5>
                                <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
                                <p><strong>Price:</strong> JOD {{ number_format($item->price_at_time, 2) }}</p>
                                <p><strong>Total:</strong> JOD {{ number_format($item->total_price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection