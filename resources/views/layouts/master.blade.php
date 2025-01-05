<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Handeva</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <!-- Essential Styles for Layout -->
    <style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        min-height: 100vh;
        background: #f8f9fa;
    }

    #layoutSidenav {
        display: flex;
        position: relative;
        min-height: 100vh;
    }

    /* Sidebar */
    .admin-sidebar-container {
        position: fixed;
        width: 250px;
        height: 100vh;
        z-index: 1040;
        top: 0;
        left: 0;
        overflow-y: auto;
    }

    /* Main Content Area */
    #layoutSidenav_content {
        flex: 1;
        margin-left: 250px;
        display: flex;
        flex-direction: column;
        min-width: 0;
        min-height: 100vh;
        position: relative;
        padding-top: 56px;
        /* Height of navbar */
    }

    /* Top Navigation */
    .admin-top-nav {
        position: fixed;
        top: 0;
        right: 0;
        left: 250px;
        z-index: 1030;
        height: 56px;
    }

    /* Main Content */
    main {
        flex-grow: 1;
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }

    /* Footer */
    footer {
        margin-top: auto;
        padding: 1rem;
        background: #fff;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    /* Responsive Layout */
    @media (max-width: 992px) {
        .admin-sidebar-container {
            transform: translateX(-250px);
            transition: transform 0.3s ease-in-out;
        }

        .admin-sidebar-container.show {
            transform: translateX(0);
        }

        #layoutSidenav_content {
            margin-left: 0;
        }

        .admin-top-nav {
            left: 0;
        }
    }

    /* DataTables Responsiveness */
    .dataTables_wrapper {
        width: 100% !important;
        overflow-x: auto;
    }

    /* Loading Animation */
    .admin-layout {
        opacity: 0;
    }

    .admin-layout.loaded {
        opacity: 1;
        transition: opacity 0.3s ease;
    }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/admin/deleteCategory.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="admin-layout">
        @include('layouts.inc.admin-navbar')

        <div id="layoutSidenav">
            @include('layouts.inc.admin-sidebar')

            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('layouts.inc.admin-footer')
            </div>
        </div>
    </div>

    @yield('scripts')

    <!-- Your existing scripts -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <!-- DataTables Initialization -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        $('.dataTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: true,
        });
    });
    </script>

    <!-- Layout Loading Animation -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.admin-layout').classList.add('loaded');
    });
    </script>

    <!-- Your existing alert scripts -->
    @if(session('successUpdate'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Updated Successfully',
        text: '{{ session('
        successUpdate ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif

    @if(session('successAdd'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Added Successfully',
        text: '{{ session('
        successAdd ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif

    @if(session('successDelete'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Deleted Successfully',
        text: '{{ session('
        successDelete ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif

    @if($errors->any())
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Validation Errors',
        html: `
        <ul style="text-align: left; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    `,
        confirmButtonText: 'Okay'
    });
    </script>
    @endif
    <!-- SweetAlert for Success Messages -->
    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('
        success ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif
</body>

</html>