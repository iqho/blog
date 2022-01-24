<div>
@section('title','Show All Users')
    <div class="card">
      <div class="card-header">
        <div class="col-md-12 text-left"><h1>Post Details</h1></div>
      </div>
      <div class="card-body">
        <div class="card-text">
            <div class="row">
                <div class="col-3">Title</div><div class="col-9">{{ $post->title }}</div>
                <div class="col-3">Slug</div><div class="col-9">{{ $post->slug }}</div>
                <div class="col-3">Feature Image</div><div class="col-9">
                @if ($post->featured_image)
                  <img src="{{ asset('storage/post-image/'.$post->featured_image) }}" alt="{{ $post->title }}" style="width: 80px; height:75px">
                @endif  
                </div>
                <div class="col-3">Status</div><div class="col-9">
                  @if ($post->publish_status == 1)
                  Active
                  @else
                  Draft
                  @endif
                </div>
                <div class="col-3">User</div><div class="col-9">{{ $post->users->name }}</div>
                <div class="col-3">Category</div><div class="col-9">{{ $post->category->name }}</div>
                <div class="col-3">Created_at</div><div class="col-9">{{ $post->created_at }}</div>
            </div>
        </div>
      </div>
    </div>
</div>

