<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<!-- BEGIN: Head-->
<head>
    @include('backend.includes.head-content')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('backend.includes.top-bar')
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    @include('backend.includes.side-menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <!-- BEGIN: Breadcrumbs -->
            <div class="content-header row">
                @include('backend.includes.breadcrumbs')
            </div>
            <!-- END: Breadcrumbs -->

            <!-- BEGIN: Main Content -->
            <div class="content-body">
                @isset($slot)
                {{ $slot }}
                @endisset
            </div>
            <!-- END: Main Content -->

        </div>

    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('backend.includes.footer')
    <!-- END: Footer-->

    <!-- BEGIN: Bottom Script-->
    @include('backend.includes.bottom-script-content')
    <!-- END: Bottom Script-->


    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

</body>
<!-- END: Body-->

</html>

