<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                        <span class="user-status">
                            @can('isAdmin')
                            Admin
                            @elsecan('isEditor')
                            Editor
                            @elsecan('isAuthor')
                            Author
                            @elsecan('isContributor')
                            Contributor
                            @else
                            Subscribers
                            @endcan
                        </span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{ Auth::user()->profile_photo_url }}"
                            alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    @can('isCommon')
                    <a class="dropdown-item" href="{{ route('admin-panel.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @else
                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @endcan

                    {{-- @can('isAdmin')
                    <a class="dropdown-item" href="{{ route('admin-panel.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @elsecan('isEditor')
                    <a class="dropdown-item" href="{{ route('editor.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @elsecan('isAuthor')
                    <a class="dropdown-item" href="{{ route('author.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @elsecan('isContributor')
                    <a class="dropdown-item" href="{{ route('contributor.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @else
                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="me-50" data-feather="user"></i> Profile</a>
                    @endcan --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="me-50" data-feather="settings"></i> Settings</a>
                    <a class="dropdown-item" href="javascript:void" onclick="$('#logout-form').submit();"><i class="me-50" data-feather="power"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
