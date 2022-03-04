@section('title', $pages->title.' | M Blog')
<div class="col-lg-8 mb-2 g-0">
    <nav aria-label="breadcrumb" class="border border-gray g-0 mb-3 p-1 pb-2 ps-4 sugg">
        <ol class="breadcrumb" style="margin: 0px;">
          <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa-solid fa-house-window"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $pages->title }}</li>
        </ol>
    </nav>
    <div class="border border-gray g-0">
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-2">
            <h2>{{ $pages->title }}</h2>
        </div>
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-1 g-0 fst-italic" style="font-size:17px; font-weight: 600;">
            Posted on: {{ date('d M Y, h:i A', strtotime($pages->created_at)) }} by <a href="{{ route('post.author-post', $pages->user->id) }}" class="d-inline text-decoration-none">{{ $pages->user->name }}</a>
        </div>
        <div class="flex-row clearfix g-0 px-md-3 px-1" style="text-align: justify;">
            @if ($pages->featured_image)
            <img src="{{ asset('storage/page-images/'.$pages->featured_image) }}" alt="{{ $pages->title }}"class="img-thumbnail" style="float:left; width:200px; height:180px; margin-right:10px; margin-top:7px">
            @endif
            <p>{!! html_entity_decode($pages->description) !!}</p>
        </div>
        <div class="flex-row g-0 border-top border-gray p-2" style="font-size:17px; font-weight: 600;">
                @php
                $data = $pages->tags;
                $sep_tag= explode(',', $data);
                @endphp
                Tags:
                @foreach ($sep_tag as $tag)
                 <a class="badge bg-secondary text-decoration-none link-light p-2">{{ $tag }}</a>
                @endforeach
                <span class="ms-1 d-inline float-end ms-2"><i class="fa-solid fa-eye" alt="{{ __('Views') }}" title="{{ __('Views') }}"></i> {{ $pages->views }}</span>
                @auth
                @if (Auth::user()->id === $pages->user->id)
            <a class="d-inline text-decoration-none float-end" href="{{ route('admin-panel.edit-page', $pages->id) }}" target="_blank"><i class="fa-solid fa-pen-to-square"></i></a>
                @endif
                @endauth
        </div>
    </div>

</div>
