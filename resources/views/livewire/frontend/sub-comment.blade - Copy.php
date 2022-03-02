<?php $dash.='-- '; ?>
@foreach ($subcomments as $subcom)
{{$dash}}{{ $subcom->comment_body }}<br>
@if(count($subcom->subcomment))
@include('livewire.frontend.sub-comment', ['subcomments' => $subcom->subcomment])
@endif
@endforeach
