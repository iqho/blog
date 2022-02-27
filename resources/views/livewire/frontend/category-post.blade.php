@if ($pageMode)
@include('livewire.frontend.single-page')
@else
@section('title', $cat_name. ' | M Blog' )
<div class="col-lg-8 mb-2 g-0 ps-4">
    <nav aria-label="breadcrumb" class="border border-gray g-0 mb-2 p-1 pb-2 ps-4 sugg">
        <ol class="breadcrumb" style="margin: 0px;">
          <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa-solid fa-house-window"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $cat_name }}</li>
        </ol>
    </nav>
    <!-- Nested row for all blog posts-->
    <div class="row g-0">
        <div class="col w-100 text-center mb-3" style="font-size: 22px;">All Post from Category: <span style="font-weight: 600">{{ $cat_name }}</span></div>
        <div class="col-12 mb-4">
            <input class="form-control form-control-lg" type="text" wire:model="searchTerm"
                placeholder="Enter Post Title for Live Search" />
        </div>
        @forelse ($posts as $post)
        <div class="blog-card g-0 mb-4" style="margin:0px">
            <div class="meta">
                @if ($post->featured_image)
                <div class="photo"
                    style="background-image: url({{ asset('storage/post-images/'.$post->featured_image) }})"></div>
                @else
                <div class="photo" style="background-image: url({{ asset('images/no-image-available.jpg') }})"></div>
                @endif
                <ul class="details">
                    <li class="author"><a href="{{ route('post.author-post', $post->users->id) }}">{{ $post->users->name }}</a></li>
                    <li class="category">{{ $post->category->name }}</li>
                    <li class="date">{{ date('d-M-Y h:i a', strtotime($post->created_at)); }}</li>
                    <li class="tags">
                        <ul>
                            @foreach ($post->tags as $tag)
                            <li><a href="{{ route('post.tag-post', $tag->slug) }}">{{ $tag->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="description pt-1 pb-2" style="min-height: 150px">
                <h1><a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}">{{ $post->title }}</a></h1>
                <p style="text-align: justify">{{ Str::limit($post->short_description, 130) }}
                    <span class="read-more" style="margin: 0px">
                        <a href="{{ route('post.single-post', [$post->category->slug, $post->slug]) }}">Read More</a>
                    </span>
                </p>
            </div>
        </div>
        @empty
        <h3 class="text-danger mx-auto w-100 text-center">No Posts Found under this Category !</h3>
        @endforelse

    </div>
    <!-- Pagination-->
    <nav aria-label="Pagination" class="mt-4">
        {{ $posts->onEachSide(2)->links('backend.includes.pagination-custom') }}
    </nav>
</div>
@endif
