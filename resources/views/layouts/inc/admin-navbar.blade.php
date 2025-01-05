<nav class="admin-top-nav">

    <!-- Sidebar Toggle -->
    <!-- <button class="admin-sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button> -->

    <!-- Messages -->
    <div class="admin-messages">
        <a class="admin-message-link" href="{{ route('contactus.index') }}" data-bs-toggle="tooltip"
            title="View Messages">
            <i class="fas fa-envelope admin-message-icon"></i>
            <span class="admin-message-badge">
                {{ App\Models\ContactUs::where('is_read', false)->count() }}
            </span>
        </a>
    </div>

    <!-- User -->
    <div class="admin-user-nav">
        <div class="admin-user-dropdown dropdown">
            <!-- Add 'dropdown' class -->
            <a class="admin-user-toggle dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                <span class="admin-user-name">{{ Auth::user()->name }}</span>
            </a>
            <ul class="admin-user-menu dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- Add 'dropdown-menu' class -->
                <li><a class="admin-menu-item" href="{{ route('admin.profile')}}">Your Profile</a></li>
                <li>
                    <hr class="admin-menu-divider">
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="admin-logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>