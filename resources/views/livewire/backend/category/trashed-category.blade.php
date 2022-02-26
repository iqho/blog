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
    @section('title','List of All Trashed Categories')

    <div class="card">
        <div class="card-header">
            <div class="col-md-7 text-center"><h1>List of All Trashed Category</h1></div>
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
                            @foreach ($data['categories'] as $category)
                                <?php $dash=''; ?>
                                <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                                <tr>
                                    <td>{{ $_SESSION['i'] }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td style="padding: 0px; text-align:center">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/category-images/'.$category->image) }}" alt="{{ $category->name }}" style="width: 40px; height:35px">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category->status == 1)
                                            <button class="btn btn-relief-success">Active</button>
                                        @else
                                            <button class="btn btn-relief-danger">Inactive</button>
                                        @endif
                                           </td>
                                    <td>
                                        @if(!empty($category->user->name))
                                            {{ $category->user->name }}
                                        @else
                                            Creator Not Found !
                                        @endif
                                    </td>
                                    <td style="max-width: 100px; text-align:center">{{ date('d-M-Y h:i a', strtotime($category->created_at)); }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" wire:click="restore({{ $category->id }})" onclick="confirm('Confirm ! You Want to Restore This Category ?') || event.stopImmediatePropagation()" class="btn btn-relief-success waves-effect waves-float waves-light" style="margin: 2px">
                                            <i class="fas fa-sync fa-lg" alt="{{ __('Restore') }}" style="margin-right: 3px"></i> <span>{{ __('Restore') }}</span>
                                        </button>
                                        <button type="button" onclick="confirm('Confirm ! You Want to Delete This Category Parmanently?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $category->id }})" class="btn btn-relief-danger waves-effect waves-float waves-light" style="margin: 2px">
                                            <i class="fas fa-trash-alt fa-lg" style="margin-right: 3px"></i> <span>P. Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center"><h1 class="text-danger">No Data Found !</h1></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $data['categories']->onEachSide(2)->links('backend.includes.pagination-custom') }}
            </div>
        </div>
    </div>
