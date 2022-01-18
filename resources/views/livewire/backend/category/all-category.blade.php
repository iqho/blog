<div>
    <style type="text/css">
    tr td{
        padding: 8px;
    }
    .btn{
        padding: 10px;
        margin: 0px; important!
    }
    .text-truncate:hover{
        overflow: visible;
        white-space: normal;
    }
    </style>
    @section('title','List of All Categories')
    @include('livewire.backend.category.create-category')
    @include('livewire.backend.category.update-category')
    <div class="card">
      <div class="card-header">
        <div class="col-md-7 text-center"><h1>List of All Category</h1></div>
        <div class="col-md-2 text-center"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-id="1" data-bs-target="#addCategoryModal" style="padding: 14px">Add New Category</a></div>
        <div class="col-md-3 justify-content-end"> <input type="text" class="form-control" placeholder="Search Users" wire:model="searchTerm" /></div>
      </div>
      <div class="card-body">
        <div class="card-text table-responsive">
            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        <div class="table-responsive">
          <table class="table table-striped table-hover border border-bottom-1 mb-1" style="width:100%">
            <thead>
              <tr>
                <th >SL</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Parent</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created_by</th>
                <th>Created_at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($data['categories']->count() > 0)
              <?php $_SESSION['i'] = 0; ?>
              @foreach ($data['categories'] as $key => $category)
                  <?php $dash=''; ?>
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
             <tr>
                <td>{{ $_SESSION['i'] }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    @if(isset($category->parent_id))
                    {{$category->subcategory->name}}
                    @else
                    None
                    @endif
                </td>
                <td style="padding: 0px; text-align:center">
                    @if ($category->image)
                    <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 40px; height:35px">
                    @endif
                </td>
                <td>
                   @if ($category->status == 1)
                   <button wire:click="updateStatus({{ $category->id }})" class="btn btn-success">Active</button>
                    @else
                    <button wire:click="updateStatus({{ $category->id }})" class="btn btn-danger">Inactive</button>
                    @endif
                    </button>
                </td>
                <td>
                    @if(!empty($category->user->name))
                        {{ $category->user->name }}
                    @else
                        Creator Not Found !
                    @endif
                </td>
                <td style="max-width: 100px; text-align:center">{{ date('d-M-Y h:i a', strtotime($category->created_at)); }}</td>
                <td style="text-align: center; max-width:50px;">
                  <a href="#" data-bs-toggle="modal" data-id="1" data-bs-target="#updateCategoryModal" wire:click="edit({{ $category->id }})"><i class="fas fa-edit fa-lg"></i></a> | <a href="#" onclick="confirm('Confirm Delete This Category ?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $category->id }})"><i class="fas fa-trash-alt fa-lg" style="color:red"></i></a>
                </td>
              </tr>
              @if(count($category->subcategory))
              @include('livewire.backend.category.sub-category-list',['subcategories' => $category->subcategory])
              @endif
              @endforeach
              @else
              <tr>
              <td colspan="9" class="text-center"><h1 class="text-danger">No Search Results Found !</h1></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
          {{ $data['categories']->onEachSide(2)->links('backend.includes.pagination-custom') }}
      </div>
    </div>
    @push('page-js')
    {{-- jQuery Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Check Slug --}}
    <script>
      $('#name').change(function(e) {
           $.get('{{ route('admin.check') }}', 
           { 'name': $(this).val() }, 
           function( data ) {
               $('#slug').val(data.slug);
           }
           );
        });
    </script>
    <script type="text/javascript">
      window.livewire.on('storeCategory', () => {
            $('#addCategoryModal').modal('hide');
            document.getElementById("image").value = null;
        });
      window.livewire.on('categoryUpdate', () => {
        $('#updateCategoryModal').modal('hide');
        });

        function checkImageExtention() {
          var fileInput = document.getElementById('image');
          var filePath = document.getElementById('image').value;
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
    </script>
    @endpush
    </div>
