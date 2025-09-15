<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/assets/img/favicon.png') }}">

    <!-- jQuery -->
    <script src="{{ asset('assets/admin/assets/js/jquery-3.2.1.min.js') }}"></script>

	<!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/bootstrap.min.js') }}"></script>

	<!-- Slimscroll JS -->
    <script src="{{ asset('assets/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

	<script src="{{ asset('assets/admin/assets/plugins/raphael/raphael.min.js') }}"></script>
	<script src="{{ asset('assets/admin/assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ asset('assets/admin/assets/js/chart.morris.js') }}"></script>

	<!-- Custom JS -->
	<script  src="{{ asset('assets/admin/assets/js/script.js') }}"></script>



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/font-awesome.min.css') }}">
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/plugins/morris/morris.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/style.css') }}">
    {{-- <!--[if lt IE 9]>
			<script src="{{ asset('assets/admin/assets/js/html5shiv.min.js') }}"></script>
			<script src="{{ asset('assets/admin/assets/js/respond.min.js') }}"></script>
		<![endif]--> --}}
</head>

<body>

    <div class="main-content">
        @include('partials.navbar')
        @include('partials.sidebar')

        <div class="container-fluid mt-4">

            @yield('admin-content')

        </div>
    </div>

    @include('partials.admin_footer')

</body>

</html>
