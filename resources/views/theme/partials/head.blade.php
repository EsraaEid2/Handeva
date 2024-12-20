<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Handéva | @yield('title')</title>

    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{ asset('assets') }}/img/favicon.ico" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" />

    <!--=== Bootstrap CSS ===-->
    <link href="{{ asset('assets') }}/css/vendor/bootstrap.min.css" rel="stylesheet">
    <!--=== Font-Awesome CSS ===-->
    <link href="{{ asset('assets') }}/css/vendor/font-awesome.css" rel="stylesheet">
    <!--=== Plugins CSS ===-->
    <link href="{{ asset('assets') }}/css/plugins.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

    <!-- Modernizer JS -->
    <script src="{{ asset('assets') }}/js/vendor/modernizr-2.8.3.min.js"></script>


    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>