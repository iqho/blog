<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->

        <!-- Styles -->

            <!-- BEGIN: Custom CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/card.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/top-nav/css/style.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/top-nav/css/ionicon.min.css') }}" />

            <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.css') }}" />
            <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css"/>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            @stack('page-css')
            @livewireStyles

        <!-- Scripts -->
       <style>
        @media (max-width: 768px) {
            .offcanvas-collapse {
            position: fixed;
            top: 56px; /* Height of navbar */
            bottom: 0;
            right: 100%;
            width:300px;
            padding-right: 1rem;
            padding-left: 1rem;
            overflow-y: auto;
            visibility: hidden;
            background-color: #343a40;
            transition: transform .3s ease-in-out, visibility .3s ease-in-out;
            border-top:1px solid rgb(212, 212, 212);
            border-right:1px solid rgb(212, 212, 212);
            padding-top: 10px;
            }

            .offcanvas-collapse.open {
            visibility: visible;
            transform: translateX(100%);
            }
            }
        </style>
    </head>
    <body>
        {{-- Main Container  --}}
        <div class="container-fluid mb-5 shadow g-0" style="max-width:1200px">
            @include('layouts.includes.top-nav')
            <div class="row g-0 text-center mb-4" style="height: 150px; border-bottom:1px solid rgb(212, 212, 212); border-top:1px solid rgb(212, 212, 212">
                <h1 class="fw-bolder">Welcome to M Blog Home</h1>
                <p class="lead mb-0">Largest Bangladeshi Blog Site</p>
            </div>
            <div class="row g-0 ps-4">
                {{ $slot }}
            </div>
            <hr>
            <div class="row g-0 text-center" style="height: 50px">
                <p class="m-0 text-center">Copyright &copy; Your Website 2021</p>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('frontend/top-nav/js/script.js') }}"></script>


    @livewireScripts
    @stack('page-js')
    </body>
</html>
