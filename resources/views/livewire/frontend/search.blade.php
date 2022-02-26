<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Autocomplete Textbox From Database with jQuery UI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>

<div class="container mt-4">

  <div class="card">
    <div class="card-header text-center font-weight-bold">
      <h2>Laravel 8 Autocomplete Textbox From Database</h2>
    </div>
    <div class="card-body">
      <form name="autocomplete-textbox" id="autocomplete-textbox" method="post" action="#">
       @csrf

        <div class="form-group">
          <label for="exampleInputEmail1">Search By Name</label>
          <input type="text" id="name" name="name" class="form-control">
        </div>

      </form>
    </div>
  </div>

</div>
</body>
<script>
 $(document).ready(function() {
    $( "#name" ).autocomplete({

        source: function(request, response) {
            $.ajax({
            url: "{{url('autocomplete-search')}}",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    return obj.title;
               });

               response(resp);
            }
        });
    },
    minLength: 2
 });
});

</script>

</html>

