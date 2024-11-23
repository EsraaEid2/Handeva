<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Dashboard Section -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Handi
                </a>

                <!-- Users Section -->
                <div class="sb-sidenav-menu-heading">Management</div>
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Users
                </a>

                <!-- Vendors Section -->
                <a class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}"
                    href="{{ url('admin/vendors') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Vendors
                </a>

                <!-- Categories Section -->
                <a class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}"
                    href="{{ url('admin/category') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                    Categories
                </a>

                <!-- Products Section -->
                <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>

                <!-- Reviews Section -->
                <a class="nav-link {{ request()->is('admin/reviews*') ? 'active' : '' }}"
                    href="{{ route('admin.reviews.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                    Reviews
                </a>

                <!-- Orders Section -->
                <a class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Orders
                </a>

                <!-- Roles Section -->
                <!-- <a class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}"
                    href="{{ route('roles.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tag"></i></div>
                    Roles
                </a> -->

            </div>
        </div>

        <!-- Footer Section -->
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
    </nav>
</div>