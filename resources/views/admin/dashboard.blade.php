@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')

<div class="stats-dashboard">
    <h2>Quick Stats</h2>
    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p id="totalUsers">0</p>
        </div>
        <div class="stat-card">
            <h3>Total Vendors</h3>
            <p id="totalVendors">0</p>
        </div>
        <div class="stat-card">
            <h3>Total Products</h3>
            <p id="totalProducts">0</p>
        </div>
        <div class="stat-card">
            <h3>Total Orders</h3>
            <p id="totalOrders">0</p>
        </div>
    </div>
</div>

<div class="dashboard-card">
    <h2>Total Products by Visibility</h2>
    <canvas id="productVisibilityChart"></canvas>
</div>

<div class="dashboard-card">
    <h2>Total Products by Category</h2>
    <canvas id="categoryChart"></canvas>
</div>

<div class="vendors-dashboard">
    <h2>Vendors Overview</h2>
    <div class="vendors-table-container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vendor Name</th>
                    <th>Email</th>
                    <th>Total Uploaded Products</th>
                    <th>Total Sold Products</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topVendors as $index => $vendor)
                <tr>
                    <td>{{ $topVendors->firstItem() + $index }}</td>
                    <td>{{ $vendor->vendor_name }}</td>
                    <td>{{ $vendor->vendor_email }}</td>
                    <td>{{ $vendor->total_uploaded_products }}</td>
                    <td>{{ $vendor->total_sold_products }}</td>
                    <td>{{ number_format($vendor->total_sold_products * $vendor->product_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $topVendors->links() }}
    </div>
</div>

<script>
// Function to simulate dynamic count increment until reaching the actual value
function updateStats() {
    // Get the actual data passed from the backend
    const totalUsers = @json($totalUsers);
    const totalVendors = @json($totalVendors);
    const totalProducts = @json($totalProducts);
    const totalOrders = @json($totalOrders);

    // Initial counts for animation
    let countUsers = 0;
    let countVendors = 0;
    let countProducts = 0;
    let countOrders = 0;

    // Set intervals to update values until they reach the actual values
    let userInterval = setInterval(() => {
        if (countUsers < totalUsers) {
            countUsers += 1;
            document.getElementById('totalUsers').innerText = countUsers;
        } else {
            clearInterval(userInterval);
        }
    }, 50); // Adjust the speed (50ms for example)

    let vendorInterval = setInterval(() => {
        if (countVendors < totalVendors) {
            countVendors += 1;
            document.getElementById('totalVendors').innerText = countVendors;
        } else {
            clearInterval(vendorInterval);
        }
    }, 50);

    let productInterval = setInterval(() => {
        if (countProducts < totalProducts) {
            countProducts += 1;
            document.getElementById('totalProducts').innerText = countProducts;
        } else {
            clearInterval(productInterval);
        }
    }, 50);

    let orderInterval = setInterval(() => {
        if (countOrders < totalOrders) {
            countOrders += 1;
            document.getElementById('totalOrders').innerText = countOrders;
        } else {
            clearInterval(orderInterval);
        }
    }, 50);
}

// Call the updateStats function to start the dynamic count
updateStats();

// Passing PHP data to JavaScript for Category Chart
var categoryLabels = @json($categoryLabels);
var categoryCounts = @json($categoryCounts);

// Create the Category Chart
var ctxCategory = document.getElementById('categoryChart').getContext('2d');
var categoryChart = new Chart(ctxCategory, {
    type: 'bar',
    data: {
        labels: categoryLabels,
        datasets: [{
            label: 'Total Products by Category',
            data: categoryCounts,
            backgroundColor: '#771011',
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                backgroundColor: 'var(--dark-color)',
                titleColor: 'var(--secondary-color)',
                bodyColor: 'var(--secondary-color)',
            }
        }
    }
});

// Passing PHP data to JavaScript for Visibility Chart
var visibilityLabels = @json($visibilityLabels);
var visibilityCounts = @json($visibilityCounts);

// Create the Visibility Chart
var ctxVisibility = document.getElementById('productVisibilityChart').getContext('2d');
var visibilityChart = new Chart(ctxVisibility, {
    type: 'pie',
    data: {
        labels: visibilityLabels,
        datasets: [{
            label: 'Total Products by Visibility',
            data: visibilityCounts,
            backgroundColor: ['#771011', '#221712'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                backgroundColor: 'var(--dark-color)',
                titleColor: 'var(--secondary-color)',
                bodyColor: 'var(--secondary-color)',
            }
        }
    }
});
</script>

@endsection