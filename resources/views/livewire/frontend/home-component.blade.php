<div class="row">
    <!-- Blog entries-->
    <div class="col-lg-8">
        <!-- Featured blog post-->
        <div class="card mb-4">
            <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                    alt="..." /></a>
            <div class="card-body">
                <div class="small text-muted">January 1, 2021</div>
                <h2 class="card-title">Featured Post Title</h2>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid
                    atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero
                    voluptate voluptatibus possimus, veniam magni quis!</p>
                <a class="btn btn-primary" href="#!">Read more →</a>
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
