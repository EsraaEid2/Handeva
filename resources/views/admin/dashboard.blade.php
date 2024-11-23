@extends('layouts.master')


@section('content')
<div class="admin-dashboard container-fluid">
    <div class="row mt-4">
        <!-- Key Metrics Cards -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-primary">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Total Sales</h5>
                    <p class="metric-card-text">₪ 150,000</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-success">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Total Orders</h5>
                    <p class="metric-card-text">250</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-warning">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Active Vendors</h5>
                    <p class="metric-card-text">15</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="metric-card metric-card-info">
                <div class="metric-card-body">
                    <h5 class="metric-card-title">Products Listed</h5>
                    <p class="metric-card-text">320</p>
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
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>New product added: "Handmade Necklace"</td>
                        <td>2 hours ago</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Order #12045 shipped</td>
                        <td>3 hours ago</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Vendor "Amani" updated their store</td>
                        <td>5 hours ago</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection