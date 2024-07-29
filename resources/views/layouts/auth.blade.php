<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auth Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('auth/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('auth/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->

            <div class="container-fluid">
                <!--  Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('auth/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('auth/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('auth/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('auth/js/app.min.js') }}"></script>
    <script src="{{ asset('auth/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('auth/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('auth/js/dashboard.js') }}"></script>
</body>

</html>