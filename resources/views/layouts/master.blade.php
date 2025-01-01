<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Handeva</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- styles -->
    <link href="{{ asset ('assets/css/styles.css')}}" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

    <!-- SweetAlert2 JS -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.min.js"></script>
    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous" defer></script>
    <!-- Bootstrap 5 JS and Popper.js (required for Bootstrap 5 components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset ('assets/js/admin/deleteCategory.js')}}"></script>
</head>

<body>
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
    @yield('scripts')
    <script src="{{ asset ('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset ('assets/js/scripts.js')}}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize all tables with DataTables if they have the class 'dataTable'
        $('.dataTable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: true,
        });
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch the unread messages count
        fetch('/admin/messages/count')
            .then(response => response.json())
            .then(data => {
                const messageCount = document.getElementById('messageCount');
                messageCount.textContent = data.unread_count;
            });
    });
    </script>
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