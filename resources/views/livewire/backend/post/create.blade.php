<x-Backend-Layout>
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
</style>
      <div class="card">
              <div class="card-header">
                <div class="col-md-12 text-left">
                  <h1>Create New Post</h1>
                </div>
              </div>
              <div class="card-body">
                <form action="{{ route('admin.post-store') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                  @csrf
                  <div class="row g-0">
                    <div class="col-md-9 shadow rounded p-1">

                          <div class="mb-1">
                            <label class="form-label" for="basic-addon-title">Title</label>
                            <input type="text" id="basic-addon-title" class="form-control" placeholder="Title" aria-label="Title"
                              aria-describedby="basic-addon-title" required />
                            <div class="valid-feedback">Looks good !</div>
                            <div class="invalid-feedback">Please Enter Post Title.</div>
                          </div>

                          <div class="mb-1">
                              <label class="form-label" for="basic-addon-title">Post Slug</label>
                              <div class="input-group mb-2">
                              <span class="input-group-text" id="slug">{{ url('/posts') }}/</span>
                              <input type="text" class="form-control" id="slug" aria-describedby="slug" placeholder="Slug" required>
                              <div class="valid-feedback">Looks good !</div>
                              <div class="invalid-feedback">Please Enter Post Slug.</div>
                              </div>
                          </div>

                          <div class="mb-1">
                            <label class="d-block form-label" for="short_description">Short Description</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
                            <div class="valid-feedback">Looks good !</div>
                            <div class="invalid-feedback">Please Enter Post Short Description.</div>
                          </div>

                          <div class="mb-1">
                            <label class="d-block form-label" for="full_description">Full Description</label>
                            <textarea class="form-control" id="full_description" name="full_description" rows="15" required></textarea>
                            <div class="valid-feedback">Looks good !</div>
                            <div class="invalid-feedback">Please Enter Post Full Description.</div>
                          </div>

                          <div class="mb-1">
                            <input type="submit" value="Post" class="btn btn-primary px-4">
                          </div>
            
            
                    </div>
                    <div class="col-md-3 ps-md-1">
                      <div class="shadow rounded">
                        <div class="card border-success mb-1">
                          <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">
                            Category</h4>
                          <div class="card-body text-success" style="padding: 8px">* </div>
                        </div>

                        <div class="accordion border border-gray" id="accordionPanelsStayOpenExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                              <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                Status & visibility
                                
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show border border-gray" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                      <div class="form-group">

                                        <div class="form-check form-check-danger">
                                          <input type="checkbox" class="form-check-input" name="isStiky" id="colorCheck5">
                                          <label class="form-check-label" for="colorCheck5">Is Stiky</label>
                                        </div>
                                        <hr/>
                                        <div class="row custom-options-checkable g-1">
                                          <div class="col-md-6">
                                            <input class="custom-option-item-check" type="radio" name="customOptionsCheckableRadios"
                                              id="customOptionsCheckableRadios1" checked="">
                                            <label class="custom-option-item" for="customOptionsCheckableRadios1">Draft
                                            </label>
                                          </div>
                                        
                                          <div class="col-md-6">
                                            <input class="custom-option-item-check" type="radio" name="customOptionsCheckableRadios"
                                              id="customOptionsCheckableRadios2" value="Publish">
                                            <label class="custom-option-item" for="customOptionsCheckableRadios2">
                                              Publish
                                            </label>
                                          </div>
                                        </div>

                                      </div>
                                </div>
                            </div>
                          </div>

                         <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                              <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                Select Parent Category (<span class="text-danger">*</span>):
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show border border-gray"
                              aria-labelledby="panelsStayOpen-headingTwo">
                              <div class="accordion-body">
                                      <div class="form-group">
                                        <select type="text" class="form-control @error('parent_id') is-invalid @enderror" name="parent_id"
                                          wire:model="parent_id">
                                          <option value="">None</option>
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
                                        @error('parent_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                      </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                              <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Accordion Item #3
                              </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse border border-gray"
                              aria-labelledby="panelsStayOpen-headingThree">
                              <div class="accordion-body">
                                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin
                                adds the appropriate classes that we use to style each element. These classes control the overall appearance, as
                                well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our
                                default variables. It's also worth noting that just about any HTML can go within the
                                <code>.accordion-body</code>, though the transition does limit overflow.
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


    </script>
    </x-Backend-Layout>

