<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Featured blog post-->
        <div class="card mb-4">
            {{-- <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                    alt="..." /></a>
            <div class="card-body">
                <div class="small text-muted">January 1, 2021</div>
                <h2 class="card-title">Featured Post Title</h2>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid
                    atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero
                    voluptate voluptatibus possimus, veniam magni quis!</p>
                <a class="btn btn-primary" href="#!">Read more →</a>
            </div> --}}


<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{ asset('backend/assets/images/banner/banner-14.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="{{ asset('backend/assets/images/banner/banner-16.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('backend/assets/images/banner/banner-10.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
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
        <!-- Nested row for non-featured blog posts-->
        <div class="row g-0">
            <div class="col-12">
                <input class="form-control mb-2" type="text" wire:model="searchTerm" placeholder="Enter Post Title for Live Search"/>
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
                        <li class="author"><a href="#">{{ $post->user->name }}</a></li>
                        <li class="date">{{ $post->category->name }}</li>
                        <li class="date">{{ date('d-M-Y h:i a', strtotime($post->created_at)); }}</li>
                        <li class="tags">
                            <ul>
                                @foreach ($post->tags as $tag)
                                <li><a href="#">{{ $tag->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="description">
                    <h1><a href="#">{{ $post->title }}</a></h1>
                    <p>{{ $post->short_description}}</p>
                    <p class="read-more">
                        <a href="#">Read More</a>
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
    <!-- Side widgets-->
    <div class="col-lg-4">
        <!-- Search widget-->
        <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
                <div class="input-group">
                    <input class="form-control" type="text" wire:model="searchTerm" placeholder="Enter Post Title for Search"
                        aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                </div>
            </div>
        </div>
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-unstyled mb-0">
                            @foreach ($categories as $category)
                            <li># <a href="#!">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Side Widget</div>
            <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use,
                and feature the Bootstrap 5 card component!</div>
        </div>
    </div>
</div>
