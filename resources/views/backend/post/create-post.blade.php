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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('admin.post-store') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form-group">
                       Title<input type="text" class="form-control" name="title" value="{{ old('title') }}" required/>
            <div class="invalid-feedback">Please Write a Post Title.</div>
            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                        SLug<input type="text" class="form-control" name="slug" value="{{ old('slug') }}" required/>
                        <div class="invalid-feedback">Please Write a Post Slug.</div>
                        @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
            </div>

            Short Des<textarea name="short_description" class="form-control" id="" cols="30" rows="3" required>{{ old('short_description') }}</textarea>
            <div class="invalid-feedback">Please Write a Short Description.</div>
            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror

            Des<textarea name="description" id="" class="form-control" cols="30" rows="10" required>{{ old('description') }}</textarea>
            <div class="invalid-feedback">Please Write a Full Description.</div>
            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror

            Meta Des<textarea name="meta_description" class="form-control" id="" cols="30" rows="3" required>{{ old('meta_description') }}</textarea>
            <div class="invalid-feedback">Please Write a Meta Description.</div>
            @error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror

            <div class="card border-success mb-1">
                <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">
                  Feature Image</h4>
                 <div class="card-body text-success" style="padding: 8px;">
                  {{-- @if($featured_image)
                  <div class="col-12 text-center w-100"><img src="{{ $featured_image->temporaryUrl() }}" style="width: 100%; max-height:200px;"></div>
                  @else
                  <div class="col-12 text-center w-100"><img src="{{ asset('backend/assets/images/slider/03.jpg') }}" style="width: 100%; max-height:200px;"></div>
                  @endif --}}
                  {{-- <div wire:loading wire:target="featured_image" class="text-success">Uploading...</div> --}}
                  <input type="file" class="form-control mt-1 @error('featured_image') is-invalid @enderror" name="featured_image" accept="image/*" id="featured_image" wire:model="featured_image" onchange="return checkImageExtention()">
                  @error('featured_image') <span class="text-danger error">{{ $message }}</span>@enderror
                  <div id="error-msg" class="text-danger"></div>
                 </div>
              </div>


            <div class="col-12">
                Select Publish Status:
                <div class="row custom-options-checkable g-0" style="margin-top: 5px">
                    <div class="col-md-6" style="margin:0px; padding: 2px">
                      <input class="custom-option-item-check" type="radio" name="publish_status"
                        id="customOptionsCheckableRadios1" value="1" checked="">
                      <label class="custom-option-item text-center" for="customOptionsCheckableRadios1" style="padding: 6px">Publish
                      </label>
                    </div>
                    <div class="col-md-6" style="margin:0px; padding: 2px">
                      <input class="custom-option-item-check" type="radio" name="publish_status"      id="customOptionsCheckableRadios2" value="0">
                      <label class="custom-option-item text-center" for="customOptionsCheckableRadios2" style="padding: 6px">
                        Draft
                      </label>
                    </div>
                  </div>
                  @error('publish_status')<div class="alert alert-danger">{{ $message }}</div>@enderror
            </div>
                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_sticky" id="" value="1">
                        Is Sticky
                    </label>
                    </div>
                    @error('is_sticky')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="allow_comments" id="" value="1">
                    Allow Comments
                    </label>
                    </div>
                    @error('allow_comments')<div class="alert alert-danger">{{ $message }}</div>@enderror

            <div class="form-group">
              <label for="">Category</label>
              <select type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" wire:model="category_id" required>
                {{-- <option>Select Post Category</option> --}}
                  @if($data['catOption'])
                  @foreach($data['catOption'] as $category)
                  <?php $dash=''; ?>
                  <option value="{{$category->id}}">{{$category->name}}</option>
                  @if(count($category->subcategory))
                  @include('livewire.backend.category.subcategoryList-option', ['subcategories' => $category->subcategory])
                  @endif
                  @endforeach
                  @endif
                </select>
                @error('category_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            Tags <input class="form-control" type="text" data-role="tagsinput" name="tags" value="{{ old('tags') }}">
            <div class="invalid-feedback">Please Write Tags.</div>
            @if ($errors->has('tags'))
            <span class="text-danger">{{ $errors->first('tags') }}</span>
            @endif
            <input type="hidden" value="1" name="user_id">
              <?php
              $date = new DateTime('2000-01-01');
              ?>
            {{-- <input type="hidden" value="{{ $date->format('Y-m-d H:i:s'); }}" name="published_at"> --}}
            <input type="submit" value="Post" class="btn btn-primary">

            </form>
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


