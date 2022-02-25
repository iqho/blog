<div>
  @section('title', 'Update Page Details')
  <style>
    .form-label {
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

    span.tag.label {
      position: relative;
      float: left;
      margin-bottom: 2px;
    }

    .twitter-typeahead .tt-query,
    .twitter-typeahead .tt-hint {
      margin-bottom: 0;
    }

    .twitter-typeahead .tt-hint {
      display: none;
    }

    .tt-menu {
      position: absolute;
      top: 100%;
      left: 0;
      z-index: 1000;
      display: none;
      float: left;
      min-width: 160px;
      padding: 5px 0;
      margin: 2px 0 0;
      list-style: none;
      font-size: 14px;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 4px;
      -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
      background-clip: padding-box;
      cursor: pointer;
    }

    .tt-suggestion {
      display: block;
      padding: 3px 20px;
      clear: both;
      font-weight: normal;
      line-height: 1.428571429;
      color: #333333;
      white-space: nowrap;
      border-bottom: 1px solid #cccccc;
    }

    .tt-suggestion:last-child {
      border-bottom: none;
    }

    .tt-suggestion:hover,
    .tt-suggestion:focus {
      color: #ffffff;
      text-decoration: none;
      outline: 0;
      background-color: #428bca;
    }
  </style>

  @push('page-css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('backend/assets/ckeditor/styles.css') }}">
  @endpush
  <div class="card">
    <div class="card-header">
      <div class="col-md-12 text-left">
        <h1>Update Page Details</h1>
      </div>
    </div>
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('admin-panel.update-page') }}" method="post" class="needs-validation"
        enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row g-0">
          <div class="col-md-9 shadow rounded p-1">
            <input type="hidden" value="{{ $page->id }}" name="page_id" />
            <div class="mb-1">
              <label class="form-label" for="basic-addon-title">Title</label>
              <input type="text" class="form-control" name="title" wire:model="title" wire:keyup="generateSlug()"
                wire:change="generateSlug()" value="{{ old('title') }}" required />
              @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
              <div class="invalid-feedback">Please Enter Post Title.</div>
            </div>

            <div class="col-12 w-100">
              <label class="form-label" for="basic-addon-title">Post Slug</label>
              <div class="input-group">
                <span class="input-group-text" id="slug">{{ url('/posts') }}/</span>
                <input type="text" class="form-control" name="slug" wire:model="slug" value="{{ old('slug') }}"
                  required />
                @error('slug') <span class="text-danger error col-12">{{ $message }}</span>@enderror
                <div class="invalid-feedback">Please Enter Post Slug.</div>
              </div>
            </div>
            <div class="clearfix">
              @if($checkMode)
              @if ($data['checkSlug'] > 0)
              <div class="col-12 text-danger">Post Slug Not Available</div>
              @else
              @if ($data['checkEmpty'] == 0)
              @else
              <div class="col-12 text-success">Post Slug Available</div>
              @endif
              @endif
              @endif
            </div>

            <div class="mb-1 mt-2" wire:ignore>
              <label class="d-block form-label" for="description">Full Description</label>
              <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                required>{!! $page->description !!}</textarea>
              @error('description') <span class="text-danger error col-12">{{ $message }}</span>@enderror
              <div class="invalid-feedback">Please Enter Post Full Description.</div>
            </div>

            <div class="mb-1">
              <label class="d-block form-label" for="meta_description">Meta Description</label>
              <textarea name="meta_description" class="form-control" cols="30" rows="3"
                required>{!! $page->meta_description !!}</textarea>
              @error('meta_description') <span class="text-danger error">{{ $message }}</span>@enderror
              <div class="invalid-feedback">Please Enter Post Meta Description.</div>
            </div>

            <div class="mb-1">
              <input type="submit" class="btn btn-primary" style="padding: 14px; margin-bottom:10px"
                value="Update Page Details" />
            </div>


          </div>
          <div class="col-md-3 ps-md-1">
            <div class="shadow rounded">
              <div class="card border-success mb-1">
                <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">
                  Feature Image</h4>
                <div class="card-body text-success" style="padding: 8px;">
                  @if ($featured_image2)
                  <img src="{{ $featured_image2->temporaryUrl() }}" style="max-height: 300px"
                    class="img-fluid img-thumbnail rounded">
                  @else
                  @if ($featured_image)
                  <img src="{{ asset('storage/page-images/'.$featured_image) }}" style="max-height: 300px"
                    class="img-fluid img-thumbnail rounded">
                  @else
                  <img src="{{ asset('images/no-image-available.jpg') }}" style="max-height: 300px"
                    class="img-fluid img-thumbnail rounded">
                  @endif
                  @endif

                  <div wire:loading wire:target="featured_image2" class="text-success">Uploading...</div>
                  <input type="file" class="form-control mt-1 @error('featured_image2') is-invalid @enderror"
                    name="featured_image2" accept="image/*" id="featured_image2" wire:model="featured_image2"
                    onchange="return checkImageExtention()">
                  @error('featured_image2') <span class="text-danger error">{{ $message }}</span>@enderror
                  <div id="error-msg" class="text-danger"></div>
                </div>
              </div>

              <div class="accordion border border-gray" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse"
                      data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                      aria-controls="panelsStayOpen-collapseOne">
                      Status & visibility
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show border border-gray"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                      <div class="form-group">
                        <div class="row g-0 mt-1">

                          <div class="form-check form-check-success col-sm-12 g-0 mb-1">
                            <input type="checkbox" class="form-check-input" name="is_sticky" wire:model="is_sticky"
                              value="1" id="is_sticky">
                            <label class="form-check-label" for="isStiky">Is Stiky</label>
                          </div>

                          {{-- <div class="form-check form-check-danger col-sm-12 g-0 mb-2">
                            <input type="checkbox" class="form-check-input" name="is_nav" wire:model="is_nav"
                              value="1" id="is_nav">
                            <label class="form-check-label" for="is_nav">Add to Nav Menu</label>
                          </div>

                          <div class="col-sm-12 g-0">
                            <label class="form-input-label" style="margin-bottom: 5px;" for="page_order">Enter Pager Order Number</label>
                            <input type="number" class="form-control" name="page_order" wire:model="page_order"
                              id="page_order">
                          </div> --}}
                        </div>
                        <hr style="margin-top: 0px; margin: 8px;" />
                        <div class="col-12">
                          Select Publish Status:
                          <div class="row custom-options-checkable g-0" style="margin-top: 5px">
                            <div class="col-md-6" style="margin:0px; padding: 2px">
                              <input class="custom-option-item-check" type="radio" name="publish_status"
                                id="customOptionsCheckableRadios1" value="1" checked>
                              <label class="custom-option-item text-center" for="customOptionsCheckableRadios1"
                                style="padding: 6px">Publish
                              </label>
                            </div>
                            <div class="col-md-6" style="margin:0px; padding: 2px">
                              <input class="custom-option-item-check" type="radio" name="publish_status"
                                id="customOptionsCheckableRadios2" value="0">
                              <label class="custom-option-item text-center" for="customOptionsCheckableRadios2"
                                style="padding: 6px">
                                Draft
                              </label>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                      data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                      aria-controls="panelsStayOpen-collapseThree">
                      Post Tags and Meta Tags
                    </button>
                  </h2>
                  <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show border border-gray"
                    aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                      @php
                      $data = $page->tags;
                      $sep_tag= explode(',', $data);
                      @endphp
                      <div class="mb-1" wire:ignore>
                        <input class="form-control" type="text" data-role="tagsinput" name="tags" id="tags"
                          value="@foreach ($sep_tag as $tag) {{ $tag }}, @endforeach" required />
                        <div class="invalid-feedback">Please Enter Minimum 1 Post Tag.</div>
                        @if ($errors->has('tags'))
                        <span class="text-danger">{{ $errors->first('tags') }}</span>
                        @endif
                      </div>

                    </div>
                  </div>
                </div>

              </div>


            </div>
          </div>
        </div>
      </form>

    </div>
  </div>

  @push('page-js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
  <script src="https://codekutu.github.io/Bootstrap4TagsInputWithTypeahead/js/typeahead.js"></script>
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
                .create(document.querySelector('#description'),{
                    ckfinder: {
                    uploadUrl: '{{route('admin-panel.ck.upload').'?_token='.csrf_token()}}'
                }
                })
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });


            // Tags Input
            var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '{{ route('admin-panel.tag-json') }}',
                cache: false
                }
            });
            tags.initialize();

            $('#tags').tagsinput({
            typeaheadjs: {
                title: 'title',
                source: tags.ttAdapter()
            }
            });
  </script>
  @endpush
</div>