<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    @if ($subcategory->posts->count() > 0)
    <li><i class="fa-solid fa-angles-right"></i> <a href="{{ route('post-category', $subcategory->slug) }}">{{$dash}}{{$subcategory->name}} ({{ $subcategory->posts->count() }})</a></li>
    @endif
    @if(count($subcategory->subcategory))
        @include('livewire.frontend.common.sub-category-list', ['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
