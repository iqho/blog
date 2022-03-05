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
            By <a href="{{ route('post.author-post', $post->user->id) }}" class="d-inline text-decoration-none">{{ $post->user->name }}</a> in <a href="{{ route('post-category', $post->category->slug) }}" class="d-inline text-decoration-none"> {{ $post->category->name }}</a> at {{ date('d M Y, h:i A', strtotime($post->created_at)) }}
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
            @if (Auth::user()->id === $post->user->id)
            <div class="d-inline text-decoration-none float-end me-1"><a class="text-decoration-none" href="{{ route('admin-panel.edit-post', $post->id) }}" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a></div>
            @endif
            @endauth
        </div>

        <div class="flex-row g-0 border-top border-gray p-2 text-left px-md-3" style="font-size:17px; font-weight: 600;">
            <div class="col mt-1 px-3">
                @auth
                @if ($post->allow_comments == 1)
                <div class="col mt-3">
                    <h5 class="w-100 p-2 g-0 ps-4 ms-3">Write New Comment</h5>
                    <form method="post" action="{{ route('comments.store')}}" style="width: 100%">
                        @csrf
                        <div class="d-flex flex-row align-items-start">
                        <img class="rounded-circle" title="{{ Auth::user()->name }}" src="{{ Auth::user()->profile_photo_url }}
                        " width="40" height="35">
                        <div class="comment-textarea-triangle w-100 p-1" style="margin-left:10px">
                        <textarea class="form-control ms-1 shadow-none textarea border-0 p-0" wire:model="comment_body" name="comment_body" placeholder="Write Your Comment Here" rows="3"></textarea>
                        <input type="hidden" name="post_id" wire:model="post_id" value="{{ $post->id }}" />
                        </div>
                        </div>
                        <div class="m-2 d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm shadow-none me-1" type="button" wire:click="store">Post Comment</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="p-2 w-100 border border-danger text-center">Commenting off by Author</h6></div>
                @endif
                @else
                <div class="p-2 ms-5"><h6>Please <a href="{{ url('/login') }}">Login</a> first for write a new comments</h6></div>
                @endauth

                @if ($post->comments->count() > 0)
                @php
                $total_comments = App\Models\Admin\Comment::where('post_id', $post->id)->count();
                @endphp
                <h5 class="mb-2 ps-2 pb-2 mt-2 border-bottom border-gray">All Comments ({{ $total_comments }})</h5>
                @include('livewire.frontend.sub-comment', ['comments' => $post->comments, 'post_id' => $post->id])
                @else
                <h5 class="w-100 text-center m-2 border-top pt-2 border-gray">No Comments</h5>
                @endif
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $(".showreply").click(function(){
            $(".comment-reply-box"+this.id).show();
            var value = $("#copyname"+this.id).html();
            var input = $("#comment_body"+this.id);
            input.val(value);
        });
        $(".closereply").click(function(){
            $(".comment-reply-box"+this.id).hide();
        });
    });
</script>

