<nav class="admin-top-nav">
    <!-- Brand -->
    <a class="admin-brand" href="{{ url('admin') }}">Handi</a>

    <!-- Sidebar Toggle -->
    <button class="admin-sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

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
        <div class="admin-user-dropdown">
            <a class="admin-user-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                <span class="admin-user-name">{{ Auth::user()->name }}</span>
            </a>
            <ul class="admin-user-menu" aria-labelledby="navbarDropdown">
                <li><a class="admin-menu-item" href="{{ route('admin.profile')}}">Your Profile</a></li>
                <li>
                    <div class="admin-menu-divider"></div>
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