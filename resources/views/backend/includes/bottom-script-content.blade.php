@livewireScripts

<!-- BEGIN: Vendor JS-->
<script src="{{ asset('backend/assets/vendors/js/vendors.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('backend/assets/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/datatable/responsive.bootstrap5.js') }}"></script>

<!-- BEGIN: Theme JS-->
<script src="{{ asset('backend/assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('backend/assets/js/core/app.js') }}"></script>

@stack('page-js')

<!-- END: Theme JS-->
