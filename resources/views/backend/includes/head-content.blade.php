    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

    <title>@yield('title') | M Blog</title>

    {{-- <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png')}}"> --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/images/ico/favicon.ico')}}"/> --}}
    <link rel="shortcut icon" href="http://www.mbd24.com/wp-content/themes/mbd24/images/comon/favicon.ico" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet"/>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/vendors/css/vendors.min.css') }}"/>
    <!-- END: Vendor CSS-->

    <!-- BEGIN: DataTable CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/datatable/responsive.bootstrap5.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap-extended.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/colors.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/components.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/dark-layout.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/themes/semi-dark-layout.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/core/menu/menu-types/vertical-menu.css') }}"/>
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}"/>
    @stack('page-css')
    <!-- END: Custom CSS-->

<!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
