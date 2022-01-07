@section('title','Show All Users')

<div class="card">
  <div class="card-header">
    <h1 class="card-title">Show All User</h1>
  </div>
  <div class="card-body">
    <div class="card-text table-responsive">
    <input type="text" class="form-control" placeholder="Search" wire:model="searchTerm" />
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
            <td>{{ $user->status }}</td>
            <td>{{ $user->created_at }}</td>
            <td><button type="button" class="btn btn-outline-primary">Edit</button></td>

          </tr>
          @endforeach

        </tbody>
      </table>
      {{ $users->onEachSide(2)->links('backend.includes.pagination-custom') }}
    </div>
  </div>
</div>