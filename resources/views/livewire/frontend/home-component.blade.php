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
                <input class="form-control mb-2" type="text" wire:model="searchTerm" placeholder="Enter Post Title for Search"/>
            </div>
            @php $count = 0; @endphp
            @foreach ($posts as $post)
            {{-- <div class="col-lg-6">
                <div class="card mb-4">
                    @if ($post->featured_image)
                    <a href="#!"><img class="card-img-top" style="max-height: 300px" src="{{ asset('storage/post-images/'.$post->featured_image) }}" alt="{{ $post->title }}" /></a>
                    @else
                    <a href="#!"><img class="card-img-top" style="max-height: 300px" src="{{ asset('images/no-image-available.jpg') }}" alt="{{ $post->title }}" /></a>
                    @endif
                    <div class="card-body">
                        <div class="small text-muted">Created by <a href="#">{{ $post->user->name }}</a>  at {{ date('d-M-Y h:i a', strtotime($post->created_at)); }}</div>
                        <h2 class="card-title h4">{{ $post->title }}</h2>
                        <p class="card-text">{{ $post->short_description }}</p>
                        <div class="row g-0 border border-danger d-flex justify-content-center">
                        <div class="col-12 align-self-center">Category: <a href="#">{{ $post->category->name }}</a> 
                            <a class="btn btn-primary float-end" href="#!">Read more →</a></div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="blog-card g-0 mb-4 {{ (++$count%2 ? "alt" : "") }}" style="margin:0px">
                <div class="meta">
                    <div class="photo"
                        style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div>
                    <ul class="details">
                        <li class="author"><a href="#">John Doe</a></li>
                        <li class="date">Aug. 24, 2015</li>
                        <li class="tags">
                            <ul>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Code</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="description">
                    <h1>Learning to Code</h1>
                    <h2>Opening a door to the future</h2>
                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta
                        praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                    <p class="read-more">
                        <a href="#">Read More</a>
                    </p>
                </div>
            </div>

            {{-- <div class="blog-card alt g-0">
                <div class="meta">
                    <div class="photo"
                        style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-2.jpg)"></div>
                    <ul class="details">
                        <li class="author"><a href="#">Jane Doe</a></li>
                        <li class="date">July. 15, 2015</li>
                        <li class="tags">
                            <ul>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Code</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="description">
                    <h1>Mastering the Language</h1>
                    <h2>Java is not the same as JavaScript</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eum dolorum architecto obcaecati enim dicta
                        praesentium, quam nobis! Neque ad aliquam facilis numquam. Veritatis, sit.</p>
                    <p class="read-more">
                        <a href="#">Read More</a>
                    </p>
                </div>
            </div> --}}
            @endforeach
            

        </div>
        <!-- Pagination-->
        <nav aria-label="Pagination">
            <hr class="my-0" />
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