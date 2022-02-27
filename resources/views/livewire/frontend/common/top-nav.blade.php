<header class="headernav sticky-top">
    <div class="containernav" >
        <section class="wrapper">
            <div class="header-item-left">
                <a href="{{ url('/') }}" class="brand">M Blog</a>
            </div>
            <!-- Navbar Section -->
            <div class="header-item-center">
                <div class="overlay"></div>
                <nav class="menu" id="menu">
                    <div class="menu-mobile-header">
                        <button type="button" class="menu-mobile-arrow"><i class="ion ion-ios-arrow-back"></i></button>
                        <div class="menu-mobile-title"></div>
                        <button type="button" class="menu-mobile-close"><i class="ion ion-ios-close"></i></button>
                    </div>
                    <ul class="menu-section" style="margin:0px">
                        <li class="menu-item"><a class="@if(Request::is('/')) active @endif" href="{{ url('/') }}">Home</a></li>
                        <li class="menu-item"><a class="@if(Request::is('/about-us')) active @endif" href="{{ url('/about-us') }}">About US</a></li>
                        <li class="menu-item"><a class="{{ Request::is('/our-vision') ? 'active' : '' }}" href="{{ url('/our-vision') }}">Our Vision</a></li>
                        <li class="menu-item"><a class="@if(Request::is('/contact-us')) active @endif" href="{{ url('/contact-us') }}">Contact Us</a></li>
                        <li class="menu-item-has-children">
                            @auth
                            <a href="#">{{ Auth::user()->name }} <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-column-1">
                                <ul>
                                    @can("isCommon")
                                    <li><a target="_blank" href="{{ route('admin-panel.dashboard') }}">Dashboard</a></li>
                                    <li><a target="_blank" href="{{ route('admin-panel.profile') }}">Profile</a></li>
                                    <li><a target="_blank" href="{{ route('admin-panel.post-create') }}">Create New Post</a></li>
                                    @else
                                    <li><a target="_blank" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                    <li><a target="_blank" href="{{ route('user.profile') }}">Profile</a></li>
                                    @endcan
                                    <li><a href="javascript:void" onclick="$('#logout-form').submit();"><i class="me-50"
                                                data-feather="power"></i> Logout</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                            @else
                            <a href="#">Accounts <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-column-1">
                                <ul>
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                </ul>
                            </div>
                            @endauth
                        </li>
                        @if ($navPage->count() > 0)
                            <li class="menu-item-has-children">
                            <a href="#">More Pages <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-column-1">
                                <ul>
                                    @foreach ($navPage as $page)
                                        <li><a href="{{ route('post-category', $page->slug) }}">{{ $page->title }}</a>
                                    @endforeach
                                </ul>
                            </div>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <div class="header-item-right">
                <form action="{{ route('post.search-post') }}" method="GET" class="searchbox">
                    <input type="search" id="search_title" placeholder="Write Post Title for Search and Press Enter" name="q" class="searchbox-input" required>
                </form>
                <a href="#" class="menu-icon"><i class="ion ion-md-heart"></i></a>
                <a href="#" class="menu-icon searchbox-icon"><i class="ion ion-md-search"></i></a>
                <button type="button" class="menu-mobile-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </section>
    </div>
</header>
@push('page-js')
<script>
    $(document).ready(function() {
    $( "#search_title" ).autocomplete({
        source: function(request, response) {
            $.ajax({
            url: "{{route('post.autocomplete-search')}}",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(item){
                    return {
                    url: item.slug,
                    value: item.title
                    }
               });

               response(resp);
            }
        });
    },

    select: function( event, ui ) {
    window.location.href = '/post/'+ui.item.url+'/';
    },
    minLength: 2
 });
});
</script>
@endpush
