@section('title', $post->title. ' | ' .$post->category->name. ' | M Blog' )
<div class="col-lg-8 mb-2 g-0">
    <nav aria-label="breadcrumb" class="border border-gray g-0 border-bottom-0 p-1 pb-2 ps-4 sugg">
        <ol class="breadcrumb" style="margin: 0px;">
          <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa-solid fa-house-window"></i></a></li>
          <li class="breadcrumb-item"><a href="{{ route('post-category', $post->category->slug) }}">{{ $post->category->name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        </ol>
    </nav>
    <div class="border border-gray g-0">
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-2">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-1 g-0 fst-italic" style="font-size:17px; font-weight: 600;">
            Category: <a href="{{ route('post-category', $post->category->slug) }}" class="d-inline text-decoration-none"> {{ $post->category->name }}</a> , Posted on: {{ date('d M Y, h:i A', strtotime($post->created_at)) }} by <a href="{{ route('post.author-post', $post->users->id) }}" class="d-inline text-decoration-none">{{ $post->users->name }}</a>
        </div>
        <div class="flex-row clearfix g-0 px-md-3 px-1" style="text-align: justify;">
            @if ($post->featured_image)
            <img src="{{ asset('storage/post-images/'.$post->featured_image) }}" alt="{{ $post->title }}"class="img-thumbnail" style="float:left; width:200px; height:180px; margin-right:10px; margin-top:7px">
            @endif
            <p>{!! html_entity_decode($post->description) !!}</p>
        </div>
        <div class="flex-row g-0 border-top border-gray p-2" style="font-size:17px; font-weight: 600;">
        Tags: @foreach ($post->tags as $tag)
                <a class="badge bg-secondary text-decoration-none link-light" href="{{ route('post.tag-post', $tag->slug) }}">{{ $tag->title }}</a>
                @endforeach
                 <span class="ms-1 d-inline float-end"><i class="fa-solid fa-eye" alt="{{ __('Views') }}" title="{{ __('Views') }}"></i> {{ $post->views }}</span>
                @auth
                @if (Auth::user()->id === $post->users->id)
            <div class="d-inline text-decoration-none float-end me-1"><a class="text-decoration-none" href="{{ route('admin-panel.edit-post', $post->id) }}" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a></div>
                @endif
                @endauth
        </div>
        <div class="flex-row g-0 border-top border-gray p-2 text-left p-md-4" style="font-size:17px; font-weight: 600;">
            <div class="col mt-3 border border-success p-3">
            @include('livewire.frontend.sub-comment', ['comments' => $post->comments, 'post_id' => $post->id])
            </div>
            <div class="col mt-3 border border-success">
            <h5 class="w-100 bg-success text-white p-2 g-0">Add New Comment</h5>
            <form method="post" action="{{ route('comments.store')}}">
                @csrf
                <div class="form-group m-2">
                    <textarea class="form-control" name="comment_body" placeholder="Write Your Comment Here"></textarea>
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
                <div class="form-group mt-1">
                    <input type="submit" class="btn btn-success m-2" value="Add Comment" />
                </div>
            </form>
            </div>

        </div>
    </div>

</div>
