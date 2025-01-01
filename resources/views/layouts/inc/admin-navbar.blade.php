<nav class="sb-topnav navbar navbar-expand navbar-dark glassy-navbar">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('admin') }}">
        <img src="{{ asset('assets/img/HandevaLogo.png') }}" alt="Logo" class="navbar-logo" />
    </a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>

    <!-- User Dropdown and Messages Icon-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown position-relative">
            <a class="nav-link" href="{{ route('contactus.index') }}" data-bs-toggle="tooltip" title="View Messages">
                <i class="fas fa-envelope"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle"
                    id="unreadMessagesCount">
                    {{ App\Models\ContactUs::where('is_read', false)->count() }}
                </span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.profile')}}">Your Profile</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
<script>
// This function sends an AJAX request to update the unread count
function markAsRead(messageId) {
    // Send AJAX request to the server to mark the message as read
    fetch(`/admin/contactus/${messageId}/mark-read`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update the unread message count on success
            if (data.success) {
                document.getElementById("unreadMessagesCount").innerText = data.newUnreadCount;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>