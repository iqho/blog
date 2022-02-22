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
                        <li><i class="fa-solid fa-angles-right"></i> <a href="#!">{{ $category->name }}</a></li>
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
                and feature the Bootstrap 5 card component!
            </div>
    </div>
</div>
