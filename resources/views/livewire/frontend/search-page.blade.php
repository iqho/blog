@section('title', $keyword.' | M Blog')
<div class="col-lg-8 mb-2 g-0">
    <nav aria-label="breadcrumb" class="border border-gray g-0 mb-2 p-1 pb-2 ps-4 sugg">
        <ol class="breadcrumb" style="margin: 0px;">
          <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa-solid fa-house-window"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Search : {{ $keyword }}</li>
        </ol>
    </nav>
        <div class="col w-100 text-center mb-1" style="font-size: 22px;">All Post from Search Keyword: <span
            style="font-weight: 600"><b style="color: red">{{ $keyword }}</b></span>
        </div>
        <hr />
        <div class="row g-0 mt-4">
            @foreach ($posts as $post)
            <div class="blog-card g-0 mb-4" style="margin:0px">
                <div class="meta">
                    @if ($post->featured_image)
                    <div class="photo"
                        style="background-image: url({{ asset('storage/post-images/'.$post->featured_image) }})"></div>
                    @else
                    <div class="photo" style="background-image: url({{ asset('images/no-image-available.jpg') }})">
                    </div>
                    @endif
                    <ul class="details">
                        <li class="author"><a href="{{ route('post.author-post', $post->user->id) }}">{{
                                $post->user->name
                                }}</a></li>
                        <li class="category"><a href="{{ route('post-category', $post->category->slug) }}">{{
                                $post->category->name }}</a></li>
                        <li class="date">{{ date('d-M-Y h:i a', strtotime($post->created_at)); }}</li>
                        <li class="tags">
                            <ul>
                                @foreach ($post->tags as $tag)
                                <li><a href="{{ route('post.tag-post', $tag->slug) }}">{{ $tag->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><i class="fa-solid fa-eye" alt="{{ __('Views') }}" title="{{ __('Views') }}"></i> {{ $post->views }} {{ __('Views') }}</li>
                    </ul>
                </div>
                <div class="description pt-1 pb-2" style="min-height: 150px">
                    <h1><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}">{{ $post->title }}</a></h1>
                    <p style="text-align: justify">{{ Str::limit($post->short_description, 130) }}
                    <span class="read-more" style="margin: 0px">
                        <a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}">Read More</a>
                    </span>
                </div>
            </div>
            @endforeach

        </div>
        <!-- Pagination-->
        <nav aria-label="Pagination" class="mt-4">
            {{ $posts->onEachSide(2)->links('backend.includes.pagination-custom') }}
        </nav>
    </div>
