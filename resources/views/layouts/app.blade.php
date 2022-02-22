<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="http://www.mbd24.com/wp-content/themes/mbd24/images/comon/favicon.ico" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->

        <!-- Styles -->

            <!-- Page Random CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/styles.css') }}" />

            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/card.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/top-nav/css/style.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/top-nav/css/ionicon.min.css') }}" />

            <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.css') }}" />
            <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            @stack('page-css')
            @livewireStyles
    </head>
    <body>
        {{-- Main Container  --}}
        <div class="container-fluid mb-5 shadow g-0" style="max-width:1200px">
            @include('layouts.includes.top-nav')
            <livewire:frontend.common.top-banner />
            <div class="row g-0 ps-4 mt-4">
                <div class="row">
                    <!-- Blog Post Content-->
                    {{ $slot }}
                    <!-- Side widgets-->
                    <livewire:frontend.common.side-widgets />
                </div>
            </div>
            <div class="row g-0 text-center border border-top" style="height: 50px">
                <p class="m-0 justify-content-center align-self-center">Copyright &copy; M Blog 2022</p>
            </div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Page Random Script -->
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>

        <script src="{{ asset('frontend/top-nav/js/script.js') }}"></script>
        @livewireScripts

        @stack('page-js')

    </body>
</html>
