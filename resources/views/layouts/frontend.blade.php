<!DOCTYPE html>
<html lang="en">

<!-- doccure/  30 Nov 2019 04:11:34 GMT -->

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>@yield('title', 'Hospital ERP')</title>

    <!-- Favicons -->
    <link type="image/x-icon" href="assets/img/favicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>


    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{--
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
   <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
   <script src="{{ asset('assets/js/respond.min.js') }}"></script>
  <![endif]-->
--}}
{{--
    @vite(['resources/js/app.js'])
    --}}

</head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('partials.header')
        <main>
            @yield('content')
        </main>
        @include('partials.footer')

    </div>
    <!-- /Main Wrapper -->

</body>

<!-- doccure/  30 Nov 2019 04:11:53 GMT -->

</html>
