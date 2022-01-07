<!-- Page layout -->
@section('title','Show All Users')
@section('page-css')
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
@endsection
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Show All User</h2>
        </div>
        <div class="card-body">
            <div class="card-text">
                {{-- <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($users as $user)   
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table> --}}

<!-- Responsive Datatable -->
<section id="responsive-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header border-bottom">
            <h4 class="card-title">Responsive Datatable</h4>
          </div>
          <div class="card-datatable">
            <table class="dt-responsive table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Post</th>
                  <th>Date</th>
                  <th>Salary</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)   
                   <tr>
                       <td>{{ $user->name }}</td>
                       <td>System Architect</td>
                       <td>Edinburgh</td>
                       <td>61</td>
                       <td>2011/04/25</td>
                       <td>$320,800</td>
                   </tr>
               @endforeach
               </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

            </div>
        </div>
    </div>
    @section('page-js')
        
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template//app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template//app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template//app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template//app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/js/scripts/tables/table-datatables-advanced.min.js"></script>


    @endsection

<!--/ Page layout -->
