<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" target="_blank" href="{{ url('/') }}"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">M Blog</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @canany(['isAdmin', 'isEditor'])

            <li class="@if(Route::is('admin-panel.dashboard') ) active @endif nav-item"><a class="d-flex align-items-center"
                    href="{{ route('admin-panel.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Home">Home</span></a>
            </li>

            @can('isAdmin')
            <li class="@if(Route::is('admin.all-users') ) active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.all-users') }}">
                    <i class="fas fa-user-tie"></i>
                    <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Users</span>
                </a>
            </li>
            @endcan

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-clone"></i><span
                                        class="menu-title text-truncate" data-i18n="Page Layouts">Posts</span><span
                                        class="badge badge-light-danger rounded-pill ms-auto me-1">4</span></a>
                <ul class="menu-content">
            
                    <li class="@if(Route::is('admin-panel.all-posts') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin-panel.all-posts') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Post</span>
                        </a>
                    </li>

                    <li class="@if(Route::is('admin-panel.my-posts') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin-panel.my-posts') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">My Post</span>
                        </a>
                    </li>

                    <li class="@if(Route::is('admin-panel.post-create') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin-panel.post-create') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Create New Post</span>
                        </a>
                    </li>
            
                    @if (request()->id)
                    <li class="@if(Route::is('admin-panel.edit-post', request()->id ) ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i class="fas fa-book-open"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Edit Post Details</span>
                        </a>
                    </li>
                    @endif
                    <li class="@if(Route::is('admin-panel.trashedPost') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin-panel.trashedPost') }}">
                            <i class="fas fa-trash-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed Post</span>
                        </a>
                    </li>
            
                </ul>
            </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-file-alt"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Pages</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">3</span></a>
                    <ul class="menu-content">
                
                        <li class="@if(Route::is('admin-panel.all-pages') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-pages') }}">
                                <i class="fas fa-file-alt"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Pages</span>
                            </a>
                        </li>
                
                        <li class="@if(Route::is('admin-panel.page-create') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.page-create') }}">
                                <i class="fas fa-file-alt"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Create New Page</span>
                            </a>
                        </li>
                
                        @if (request()->id)
                        <li class="@if(Route::is('admin-panel.edit-page', request()->id ) ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="#">
                                <i class="fas fa-book-open"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Edit Page Details</span>
                            </a>
                        </li>
                        @endif
                        <li class="@if(Route::is('admin-panel.trashed-pages') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.trashed-pages') }}">
                                <i class="fas fa-trash-alt"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed Page</span>
                            </a>
                        </li>
                
                    </ul>
                </li>
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-list-alt"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Categories</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">2</span></a>
                    <ul class="menu-content">
                
                        <li class="@if(Route::is('admin-panel.category') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.category') }}">
                                <i class="fa fa-list-alt"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Category</span>
                            </a>
                        </li>
                
                        <li class="@if(Route::is('admin-panel.trashedCategory') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.trashedCategory') }}">
                                <i class="fas fa-trash-alt"></i>
                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed Category</span>
                            </a>
                        </li>
                
                    </ul>
                </li>
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-icons"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Media</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">3</span></a>
                    <ul class="menu-content">
                        @if(Route::is('admin-panel.media.list-view') )
                        <li class="@if(Route::is('admin-panel.media.list-view') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.media.list-view') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Media</span>
                            </a>
                        </li>
                        @else
                         <li class="@if(Route::is('admin-panel.media') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.media') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Media</span>
                            </a>
                        </li>                      
                        @endif

                        <li class="@if(Route::is('admin-panel.media.my-media') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.media.my-media') }}">
                                <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">My Media</span>
                            </a>
                        </li>
                        <li class="@if(Route::is('admin-panel.media.trashed') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.media.trashed') }}">
                                <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed
                                    Media</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-tags"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Tags</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">2</span></a>
                    <ul class="menu-content">
                        <li class="@if(Route::is('admin-panel.all-tags') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-tags') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Tags</span>
                            </a>
                        </li>
                        <li class="@if(Route::is('admin-panel.tag.trashed-tag') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.tag.trashed-tag') }}">
                                <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed
                                    Tag</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-border-all"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Widget</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">2</span></a>
                    <ul class="menu-content">
                        <li class="@if(Route::is('admin-panel.all-widgets') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-widgets') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Widgets</span>
                            </a>
                        </li>
                        <li class="@if(Route::is('admin-panel.all-trashed-widgets') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-trashed-widgets') }}">
                                <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed
                                    Widgets</span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-comments"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Comments</span><span
                            class="badge badge-light-danger rounded-pill ms-auto me-1">3</span></a>
                    <ul class="menu-content">
                        <li class="@if(Route::is('admin-panel.all-comments') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-comments') }}">
                                <i class="fas fa-comments"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Comments</span>
                            </a>
                        </li>
                        <li class="@if(Route::is('admin-panel.all-inactive-comments') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-inactive-comments') }}">
                                <i class="fas fa-comments"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Inactive Comments</span>
                            </a>
                        </li>
                        <li class="@if(Route::is('admin-panel.all-trashed-comments') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('admin-panel.all-trashed-comments') }}">
                                <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed
                                    Comments</span>
                            </a>
                        </li>
                    </ul>
                </li>

            @endcanany

            @can('isAuthor')
            <li class="@if(Route::is('author.dashboard') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('author.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a></li>
            <li class="@if(Route::is('author.profile') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('author.profile') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Profile">Profile</span></a></li>
            
           <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-clone"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Posts</span><span
                        class="badge badge-light-danger rounded-pill ms-auto me-1">3</span></a>
                <ul class="menu-content">
            
                    <li class="@if(Route::is('author.all-posts') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('author.all-posts') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Post</span>
                        </a>
                    </li>
            
                    <li class="@if(Route::is('author.post-create') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('author.post-create') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Create New Post</span>
                        </a>
                    </li>
            
                    @if (request()->id)
                    <li class="@if(Route::is('author.edit-post', request()->id ) ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i class="fas fa-book-open"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Edit Post Details</span>
                        </a>
                    </li>
                    @endif
                    <li class="@if(Route::is('author.trashedPost') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('author.trashedPost') }}">
                            <i class="fas fa-trash-alt"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed Post</span>
                        </a>
                    </li>
            
                </ul>
            </li> 

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fas fa-icons"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Media</span><span
                        class="badge badge-light-danger rounded-pill ms-auto me-1">2</span></a>
                <ul class="menu-content">
                    @if(Route::is('author.media.list-view') )
                        <li class="@if(Route::is('author.media.list-view') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('author.media.list-view') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Media</span>
                            </a>
                        </li>
                    @else
                        <li class="@if(Route::is('author.media') ) active @endif nav-item">
                            <a class="d-flex align-items-center" href="{{ route('author.media') }}">
                                <i class="fas fa-photo-video"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">All
                                    Media</span>
                            </a>
                        </li>
                    @endif
                    <li class="@if(Route::is('author.media.trashed') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('author.media.trashed') }}">
                            <i class="fas fa-trash-alt"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Trashed
                                Media</span>
                        </a>
                    </li>
                </ul>
            </li>


            @elsecan('isContributor')
            <li class="@if(Route::is('contributor.dashboard') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('contributor.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a></li>
            <li class="@if(Route::is('contributor.profile') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('contributor.profile') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Profile">Profile</span></a></li>
           
           <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa fa-clone"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Posts</span><span
                        class="badge badge-light-danger rounded-pill ms-auto me-1">2</span></a>
                <ul class="menu-content">
            
                    <li class="@if(Route::is('contributor.all-posts') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('contributor.all-posts') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">All Post</span>
                        </a>
                    </li>
            
                    <li class="@if(Route::is('contributor.post-create') ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('contributor.post-create') }}">
                            <i class="far fa-sticky-note"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Create New Post</span>
                        </a>
                    </li>
            
                    @if (request()->id)
                    <li class="@if(Route::is('contributor.edit-post', request()->id ) ) active @endif nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i class="fas fa-book-open"></i>
                            <span class="menu-item text-truncate" data-i18n="Collapsed Menu">Edit Post Details</span>
                        </a>
                    </li>
                    @endif            
                </ul>
            </li>

            @elsecan('isSubscribers')
            <li class="@if(Route::is('user.dashboard') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('user.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a></li>
            <li class="@if(Route::is('user.profile') ) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('user.profile') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Profile">Profile</span></a></li>
            @endcan

        </ul>
    </div>
</div>
