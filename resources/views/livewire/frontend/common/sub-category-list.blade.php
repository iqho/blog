<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
        <li><i class="fa-solid fa-angles-right"></i> <a href="{{ route('post.category-post', $subcategory->slug) }}">{{$dash}}{{$subcategory->name}}</a></li>
    @if(count($subcategory->subcategory))
        @include('livewire.frontend.common.sub-category-list', ['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
