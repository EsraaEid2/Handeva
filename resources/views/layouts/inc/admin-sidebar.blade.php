<div class="admin-sidebar-container">
    <nav class="admin-sidebar admin-sidebar-dark" id="adminSidebarMenu">
        <div class="admin-sidebar-content">
            <div class="admin-nav-list">
                <!-- Dashboard Section -->
                <a class="admin-nav-item {{ request()->is('admin') ? 'active' : '' }}"
                    href="{{ url('admin/dashboard') }}">
                    <div class="admin-nav-icon"><i class="fas fa-tachometer-alt"></i></div>
                    <span class="admin-nav-text">Dashboard</span>
                </a>

                <!-- Management Section -->
                <a class="admin-nav-item {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-users"></i></div>
                    <span class="admin-nav-text">Users</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/vendors*') ? 'active' : '' }}"
                    href="{{ url('admin/vendors') }}">
                    <div class="admin-nav-icon"><i class="fas fa-store"></i></div>
                    <span class="admin-nav-text">Vendors</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/category*') ? 'active' : '' }}"
                    href="{{ url('admin/category') }}">
                    <div class="admin-nav-icon"><i class="fas fa-th-list"></i></div>
                    <span class="admin-nav-text">Categories</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/products*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-box"></i></div>
                    <span class="admin-nav-text">Products</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/customizations*') ? 'active' : '' }}"
                    href="{{ route('admin.customizations.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-cogs"></i></div>
                    <span class="admin-nav-text">Product Customizations</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/reviews*') ? 'active' : '' }}"
                    href="{{ route('admin.reviews.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-star"></i></div>
                    <span class="admin-nav-text">Reviews</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-shopping-cart"></i></div>
                    <span class="admin-nav-text">Orders</span>
                </a>

                <a class="admin-nav-item {{ request()->is('admin/roles*') ? 'active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <div class="admin-nav-icon"><i class="fas fa-user-tag"></i></div>
                    <span class="admin-nav-text">Roles</span>
                </a>
            </div>
        </div>
    </nav>
</div>