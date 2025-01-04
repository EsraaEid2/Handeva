    @extends('theme.master')
    @section('title','Home')
    @section('home-active','active')

    @section('content')
    @include('theme.partials.banner')
    @include('theme.partials.new_products')
    @include('theme.partials.product_categories')
    @include('theme.partials.vendor_section')
    @include('theme.partials.bazaar')
    @include('theme.partials.features')

    @if(session('status') === 'pending_vendor')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: 'Thank you for registering as a vendor!',
        text: 'Your request is under review. We will contact you soon. Stay tuned and get ready to join our amazing marketplace!',
        confirmButtonText: 'OK',
    });
});
    </script>
    @endif


    @endsection