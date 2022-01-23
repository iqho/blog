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
            </div>
        </div>
      </div>
    </div>
</div>

