<div class="col-lg-8 mb-2 g-0">
    <div class="border border-gray g-0">
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-2">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-1 g-0 fst-italic" style="font-size:17px; font-weight: 600;">
            Category: <a href="#" class="d-inline text-decoration-none"> {{ $post->category->name }}</a> , Posted on: {{ date('d M Y, h:i A', strtotime($post->created_at)) }} by <a href="#" class="d-inline text-decoration-none">{{ $post->users->name }}</a>
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

                @auth
                @if (Auth::user()->id === $post->users->id)
            <a class="d-inline text-decoration-none float-end" href="{{ route('admin-panel.edit-post', $post->id) }}" target="_blank">Edit</a>
                @endif
                @endauth
        </div>
    </div>

</div>
