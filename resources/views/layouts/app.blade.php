<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
            <!-- BEGIN: Page CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/core/menu/menu-types/vertical-menu.css') }}" />
            <!-- END: Page CSS-->
            
            <!-- BEGIN: Custom CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/card.css') }}" />
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>
            
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
            width:250px;
            padding-right: 1rem;
            padding-left: 1rem;
            overflow-y: auto;
            visibility: hidden;
            background-color: #343a40;
            transition: transform .3s ease-in-out, visibility .3s ease-in-out;
            }
            
            .offcanvas-collapse.open {
            visibility: visible;
            transform: translateX(100%);
            }
            }
            .affix {
            top:50px;
            position:fixed;
            }
        </style> 
    </head>
    <body>

        <!-- Page header with logo and tagline-->

        <!-- Page content-->
        <div class="container">


            <div class="container">
                @include('layouts.includes.top-nav')
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to M Blog Home</h1>
                    <p class="lead mb-0">Largest Bangladeshi Blog Site</p>
                </div>
        
            </div>
     


        {{ $slot }}
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>

        <script>
            (function() {
            'use strict'
            document.querySelector('#navbarSideCollapse').addEventListener('click', function() {
            document.querySelector('.offcanvas-collapse').classList.toggle('open')
            })
            })()
 </script>

    @livewireScripts
    @stack('page-js')
    </body>
</html>
