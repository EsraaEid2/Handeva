<!DOCTYPE html>
<html class="no-js" lang="zxx">

@include('theme.partials.head')

<body>
    @include('theme.partials.header')

    @yield('content')

    @include('theme.partials.footer')

    <!-- Start All Modal Content -->
    @include('theme.partials.quick-view-modal')
    <!-- End All Modal Content -->

    @include('theme.partials.scripts')

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
    @if(session('vendorPending'))
    <script>
    Swal.fire({
        icon: 'warning',
        title: 'Pending Vendor Approval',
        text: '{{ session('
        vendorPending ') }}',
        confirmButtonText: 'Okay'
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

    @if(session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('
        error ') }}',
        confirmButtonText: 'Try Again'
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

    @if(session('vendorSuccessAdd'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Your vendor account has been created and is pending approval.',
        text: '{{ session('
        vendorSuccessAdd ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif
    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'successSent',
        title: 'Message Sent',
        text: '{{ session('
        success ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    </script>
    @endif

    <script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this action!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }
    </script>
</body>

</html>