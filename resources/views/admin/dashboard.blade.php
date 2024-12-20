@extends('layouts.master')

@section('content')
/* Custom dashboard styling */
.metric-card {
border-radius: 10px;
box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.metric-card-body {
padding: 20px;
color: white;
}

.metric-card-title {
font-size: 18px;
font-weight: bold;
}

.metric-card-text {
font-size: 24px;
font-weight: bold;
}

.activity-table th, .activity-table td {
font-size: 14px;
padding: 12px;
}

.activity-table tr:nth-child(even) {
background-color: #f9f9f9;
}

.activity-table th {
background-color: #007bff;
color: white;
}

<div class="admin-dashboard container-fluid">
    <div class="row mt-4">
        <!-- Key Metrics Cards -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-primary">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Total Sales</h5>
                    <p class="metric-card-text">₪ {{ number_format($totalSales, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-success">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Total Orders</h5>
                    <p class="metric-card-text">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-warning">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Active Vendors</h5>
                    <p class="metric-card-text">{{ $activeVendors }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-info">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Products Listed</h5>
                    <p class="metric-card-text">{{ $productsListed }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="card mt-4 activity-card">
        <div class="card-header">
            Recent Activity
        </div>
        <div class="card-body">
            <table class="table activity-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
@endsection