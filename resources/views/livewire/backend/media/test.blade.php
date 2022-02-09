<x-Backend-Layout>
<div class="row">@if($previous) <div class="col-2"><a href="{{ $previous->id }}">Pre</a></div> @endif <div class="col-8"><h1>{{ $media->title }}</h1></div>   @if($next) <div class="col-2"><a href="{{ $next->id }}">Next</a>@endif</div></div> 
</x-Backend-Layout>