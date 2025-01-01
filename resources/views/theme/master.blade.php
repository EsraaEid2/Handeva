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


</body>

</html>