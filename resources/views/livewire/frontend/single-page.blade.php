<div class="col-lg-8 mb-2 g-0">
    <div class="border border-gray g-0">
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-2">
            <h2>{{ $page->title }}</h2>
        </div>
        <div class="flex-row border-bottom border-gray px-md-3 px-1 py-1 g-0 fst-italic" style="font-size:17px; font-weight: 600;">
            Posted on: {{ date('d M Y, h:i A', strtotime($page->created_at)) }} by <a href="#" class="d-inline text-decoration-none">{{ $page->users->name }}</a>
        </div>
        <div class="flex-row clearfix g-0 px-md-3 px-1" style="text-align: justify;">
            @if ($page->featured_image)
            <img src="{{ asset('storage/page-images/'.$page->featured_image) }}" alt="{{ $page->title }}"class="img-thumbnail" style="float:left; width:200px; height:180px; margin-right:10px; margin-top:7px">
            @endif
            <p>{!! html_entity_decode($page->description) !!}</p>
        </div>
        <div class="flex-row g-0 border-top border-gray p-2" style="font-size:17px; font-weight: 600;">
                @php
                $data = $page->tags;
                $sep_tag= explode(',', $data);
                @endphp
                Tags:
                @foreach ($sep_tag as $tag)
                 <a class="badge bg-secondary text-decoration-none link-light p-2">{{ $tag }}</a>
                @endforeach

                @auth
                @if (Auth::user()->id === $page->users->id)
            <a class="d-inline text-decoration-none float-end" href="{{ route('admin-panel.edit-post', $page->id) }}" target="_blank">Edit</a>
                @endif
                @endauth
        </div>
    </div>

</div>
