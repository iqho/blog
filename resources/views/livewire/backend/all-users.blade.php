@section('title','Show All Users')
<div>
@include('livewire.backend.create')
@include('livewire.backend.update')
<div class="card">
  <div class="card-header">
    <div class="col-md-7 text-center"><h1>List of All Users</h1></div>
    <div class="col-md-2 text-center"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-id="1" data-bs-target="#addUserModal">Add New User</a></div>
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
        
      
      <table class="table table-striped border border-bottom-1 mb-1" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Phone Number</th>
            <th>Bio</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if($users->count() > 0)
          @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if ($user->user_type == 1)
              <button class="btn btn-danger">Admin</button>
              @elseif ($user->user_type == 2)
              <button class="btn btn-success">Editor</button>
              @elseif ($user->user_type == 3)
              <button class="btn btn-primary">Author</button>
              @elseif ($user->user_type == 4)
              <button class="btn btn-info">Contributor</button>
              @else
              <button class="btn btn-warning">Subscriber</button>
              @endif
            </td>
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
            <td>
              <a href="#" data-bs-toggle="modal" data-id="1" data-bs-target="#updateUserModal" wire:click="edit({{ $user->id }})"><i class="fas fa-edit"></i></a> | <a href="#" onclick="confirm('Confirm Delete This User ?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $user->id }})"><i class="fas fa-trash-alt" style="color:red"></i></a>
            </td>
          </tr>
          @endforeach     
          @else
          <tr>
          <td colspan="9" class="text-center"><h1 class="text-danger">No Search Results Found !</h1></td>
          </tr>
          @endif
        </tbody>
      </table>
      {{ $users->onEachSide(2)->links('backend.includes.pagination-custom') }}

    </div>
  </div>
</div>
@push('page-js')
<script type="text/javascript">
  window.livewire.on('userStore', () => {
        $('#addUserModal').modal('hide');
    });
  window.livewire.on('userUpdate', () => {
    $('#updateUserModal').modal('hide');
    });
</script>
@endpush
</div>