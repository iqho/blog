<div>
@section('title', $post->title)
    <div class="card">
      <div class="card-header">
        <div class="col-md-12 text-left"><h1>Post Details</h1></div>
      </div>
      <div class="card-body">
        <div class="row g-0">
            <div class="col-md-9 shadow rounded">
                <h2 class="col-12 p-1 m-0">{{ $post->title }}</h2>
                <hr style="margin: 0px; color:rebeccapurple"/>
                <div class="col-12 p-1 pt-1" style="text-align: justify;"><span class="col-12 m-0 h4">Short Description : </span><br>{{ $post->short_description }}</div>
                <div class="col-12 p-1 pt-0" style="text-align: justify;"><span class="col-12 m-0 h4">Description : </span><br>{!! html_entity_decode($post->description) !!}</div>
                <div class="col-12 p-1 pt-0" style="text-align: justify;"><span class="col-12 m-0 h4">Meta Description : </span><br>{{ $post->meta_description }}</div>
                <div class="col-12 p-1 pt-0" style="text-align: justify;"><span class="col-12 m-0 h4">Tags : </span><br>
                    @foreach ($post->tags as $tag)
                        <a href="#"><span class="bg-secondary text-white rounded-1" style="padding: 3px">{{ $tag->title }}</span></a>
                    @endforeach
                </div>

                <div class="col-12 p-1 pt-0" style="text-align: justify;">
                    <span class="col-12 m-0 h6">Views : {{ $post->views }}</span> |
                    <span class="col-12 m-0 h6">Order : {{ $post->post_order }}</span> |
                    <span class="col-12 m-0 h6">Published at : {{ date('d-M-Y h:i a', strtotime($post->published_at)); }}</span> |
                    <span class="col-12 m-0 h6">Created at : {{ date('d-M-Y h:i a', strtotime($post->created_at)); }}</span> |
                    <span class="col-12 m-0 h6">Updated at : {{ date('d-M-Y h:i a', strtotime($post->updated_at)); }}</span> |
                    <span class="col-12 m-0 h6">Deleted at : {{ date('d-M-Y h:i a', strtotime($post->deleted_at)); }}</span>
                </div>
             </div>
            <div class="col-md-3 ps-md-1">
                <div class="shadow rounded">

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Category</h4>
                    <div class="card-body text-success" style="padding: 8px">* {{ $post->category->name }}</div>
                  </div>

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Author</h4>
                    <div class="card-body text-success" style="padding: 8px">* {{ $post->user->name }}</div>
                  </div>

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Tags</h4>
                    <div class="card-body text-success" style="padding: 8px">
                        @foreach ($post->tags as $tag)
                        <a href="#"><span class="bg-secondary text-white rounded-1" style="padding: 3px">{{ $tag->title }}</span></a>
                        @endforeach
                    </div>
                  </div>

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Published Status</h4>
                    <div class="card-body text-success" style="padding: 8px">
                      @if ($post->publish_status == 1)
                      Publish
                      @else
                      Draft
                      @endif
                    </div>
                  </div>

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Is Sticky</h4>
                    <div class="card-body text-success" style="padding: 8px">
                      @if ($post->is_sticky == 1)
                      Sticky
                      @else
                      No Sticky
                      @endif
                    </div>
                  </div>

                  <div class="card border-success mb-1">
                    <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Allow Comments ?</h4>
                    <div class="card-body text-success" style="padding: 8px">
                      @if ($post->allow_comments == 1)
                      Allow
                      @else
                      Commenting Off
                      @endif
                    </div>
                  </div>

                    @if ($post->featured_image)
                        <div class="card border-success mb-1">
                            <h4 class="card-header bg-success text-white border-bottom-success" style="padding: 8px; margin:0px;">Feature Image</h4>
                            <div class="card-body text-success" style="padding: 8px"><img class="img-fluid" style="height:300px; max-height:200px" src="{{ asset('storage/post-images/'.$post->featured_image) }}" alt=""> </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

