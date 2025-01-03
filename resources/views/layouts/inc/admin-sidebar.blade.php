<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark glassy-sidenav" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Dashboard Section -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- Management Section -->
                <div class="sb-sidenav-menu-heading">Management</div>
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                </a>
                <a class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}"
                    href="{{ url('admin/vendors') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Vendors
                </a>
                <a class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}"
                    href="{{ url('admin/category') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Categories
                </a>
                <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>
                <a class="nav-link {{ request()->is('admin/customizations*') ? 'active' : '' }}"
                    href="{{ route('admin.customizations.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                    Product Customizations
                </a>

                <a class="nav-link {{ request()->is('admin/reviews*') ? 'active' : '' }}"
                    href="{{ route('admin.reviews.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                    Reviews
                </a>
                <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Orders
                </a>
                <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tag"></i></div>
                    Roles
                </a>

            </div>
    </nav>
</div>