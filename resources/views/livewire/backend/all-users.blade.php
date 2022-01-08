@section('title','Show All Users')

<div class="card">
  <div class="card-header">
    
    <div class="col-md-6 text-center"><h1>List of All Users</h1></div>
    <div class="col-md-3 justify-content-end"> <input type="text" class="form-control" placeholder="Search Users" wire:model="searchTerm" /></div>

  </div>
  <div class="card-body">
    <div class="card-text table-responsive">
        {{-- @include('livewire.backend.create')
        @include('livewire.backend.update') --}}
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show p-1" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      <table class="table table-striped border border-bottom-1 mb-1" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Phone Number</th>
            <th>Bio</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone_no }}</td>
            <td>{{ $user->bio }}</td>
            <td>
               @if ($user->status ==1)
               <button wire:click="updateStatus({{ $user->id }})" class="btn btn-success">Active</button>
                @else
                <button wire:click="updateStatus({{ $user->id }})" class="btn btn-danger">Inactive</button>
                @endif
            </button>
                
            </td>
            <td>{{ $user->created_at }}</td>
            <td><a href="#" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $user->id }})"><i class="fas fa-edit"></i></a> | <a href="#" onclick="confirm('Confirm Delete This User ?') || event.stopImmediatePropagation()" wire:click="delete({{ $user->id }})"><i class="fas fa-trash-alt" style="color:red"></i></a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      {{ $users->onEachSide(2)->links('backend.includes.pagination-custom') }}
    </div>
  </div>
</div>
@push('page-js')

@endpush