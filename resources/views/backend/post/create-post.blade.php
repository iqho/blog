<x-backend-layout>
@section('title', 'Create New Post')
<style>
.form-label{
  font-size: 16px;
}
.accordion-button::after {
background-image: url("{{ asset('backend/assets/images/arrow/arrow.png') }}");
transition: all 0.5s;
}
.accordion-button:not(.collapsed)::after {
background-image: url("{{ asset('backend/assets/images/arrow/arrow.png') }}");
transition: all 0.5s;
}

.bootstrap-tagsinput .tag {
    margin-right: 2px;
    color: #ffffff;
    background: #2196f3;
    padding: 3px 7px;
    border-radius: 3px;
}

.bootstrap-tagsinput {
    width: 100%;
}
</style>

@push('page-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('backend/assets/ckeditor/styles.css') }}">
@endpush

<div class="row">
    <div class="col-12">
        
    </div>
</div>



    @push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('backend/assets/ckeditor/ckeditor.js') }}"></script>
        <script>
        (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
        }
        form.classList.add('was-validated')
        }, false)
        })
        })();

        function checkImageExtention() {
          var fileInput = document.getElementById('featured_image');
          var filePath = document.getElementById('featured_image').value;
          var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
          if(!allowedExtensions.exec(filePath)){
            if(!document.getElementById("error-msg").childNodes.length){
                var gendererror = document.createElement("span");
                gendererror.innerHTML = "Supported Image Extention Only .jpeg/.jpg/.png/.gif";
                document.getElementById("error-msg").appendChild(gendererror);
            }
              //alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
              fileInput.value = '';
              return false;
          }
         }

        // CK Ediotr
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

    </script>
    @endpush
</x-backend-layout>


