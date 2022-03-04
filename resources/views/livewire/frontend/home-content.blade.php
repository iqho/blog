<div class="col-lg-8">
    <!-- Featured Blog Post Carousel -->
    @if ($stickyPost->count() > 0)
        <div class="card mb-4">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" style="height: 300px">

                <ol class="carousel-indicators">
                    @foreach ($stickyPost as $key => $spost)
                        <li type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $key }}" class="{{$key == 0 ? 'active' : ''}}"></li>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    @foreach ($stickyPost as $spost)
                    <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}" data-bs-interval="5000">
                        <img src="{{ asset('storage/post-images/'.$spost->featured_image) }}" style="max-height: 300px" class="d-block w-100" alt="...">
                        <div class="carousel-caption">
                            <h5><a href="{{ route('post.single-post', [$spost->category->slug, $spost->slug]) }}">{{ $spost->title }}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>
        </div>
    @endif
    <!-- Nested row for all blog posts-->
    <div class="row g-0">
        <div class="col-12 mb-4">
            <input class="form-control form-control-lg" type="text" wire:model="searchTerm" placeholder="Enter Post Title for Live Search"/>
        </div>
        @foreach ($posts as $post)

        <div class="blog-card g-0 mb-4" style="margin:0px">
            <div class="meta">
                @if ($post->featured_image)
                <div class="photo" style="background-image: url({{ asset('storage/post-images/'.$post->featured_image) }})"></div>
                @else
                <div class="photo" style="background-image: url({{ asset('images/no-image-available.jpg') }})"></div>
                @endif
                <ul class="details">
                    <li class="author"><a href="{{ route('post.author-post', $post->user->id) }}">{{ $post->user->name }}</a></li>
                    <li class="category"><a href="{{ route('post-category', $post->category->slug) }}">{{ $post->category->name }}</a></li>
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
            </p>
            </div>
        </div>
        @endforeach

    </div>
    <!-- Pagination-->
    <nav aria-label="Pagination" class="mt-4">
        {{ $posts->onEachSide(2)->links('backend.includes.pagination-custom') }}
    </nav>
</div>
